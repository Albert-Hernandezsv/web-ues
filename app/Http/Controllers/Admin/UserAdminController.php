<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\PanelPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserAdminController extends Controller
{
    public function index() {
        Gate::authorize('users.manage');
        return view('admin.users.index', ['users'=>User::orderBy('name')->paginate(15)]);
    }
    public function create() {
        Gate::authorize('users.manage');
        return view('admin.users.form', ['account'=>new User(['name'=>'','email'=>'']), 'modules'=>PanelPermissions::modules()]);
    }
    public function edit(User $user) {
        Gate::authorize('users.manage');
        return view('admin.users.form', ['account'=>$user, 'modules'=>PanelPermissions::modules()]);
    }
    private function validated(Request $request, ?User $user = null): array {
        return $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','email','max:255',Rule::unique('users')->ignore($user?->id)],
            'password'=>[$user ? 'nullable' : 'required','string','min:12','max:255','confirmed'],
            'role'=>['required',Rule::in(['admin','editor'])],
            'is_active'=>['required','boolean'],
            'permissions'=>['nullable','array'],
            'permissions.*'=>['string',Rule::in(PanelPermissions::all())],
        ]);
    }
    public function store(Request $request) {
        Gate::authorize('users.manage');
        $data = $this->validated($request);
        $data['permissions'] = $data['role'] === 'admin' ? [] : PanelPermissions::normalize($data['permissions'] ?? []);
        unset($data['password_confirmation']);
        $user = new User();
        $user->forceFill($data)->save(); // User's hashed cast stores the password securely.
        return redirect()->route('admin.users.index')->with('success','Cuenta creada correctamente.');
    }
    public function update(Request $request, User $user) {
        Gate::authorize('users.manage');
        $data = $this->validated($request, $user);
        DB::transaction(function () use ($data, $user, $request) {
            // Serialize account changes so concurrent demotions cannot remove every administrator.
            $accounts = User::orderBy('id')->lockForUpdate()->get();
            $actor = $accounts->firstWhere('id', $request->user()->id);
            abort_unless($actor?->is_active && $actor->role === 'admin', 403);
            $target = $accounts->firstWhere('id', $user->id);
            abort_unless($target, 404);
            if ($target->role === 'admin' && $target->is_active &&
                ($data['role'] !== 'admin' || !$data['is_active']) &&
                $accounts->where('role','admin')->where('is_active',true)->count() <= 1) {
                throw ValidationException::withMessages(['role'=>'Debe existir al menos un administrador activo.']);
            }
            $target->name = $data['name'];
            if ($target->email !== $data['email']) $target->email_verified_at = null;
            $target->email = $data['email'];
            $target->role = $data['role'];
            $target->is_active = (bool) $data['is_active'];
            $target->permissions = $data['role'] === 'admin' ? [] : PanelPermissions::normalize($data['permissions'] ?? []);
            if (!empty($data['password'])) $target->password = $data['password'];
            if (!$target->is_active || !empty($data['password'])) {
                $target->remember_token = Str::random(60);
                if (config('session.driver') === 'database') {
                    $sessions = DB::connection(config('session.connection'))->table(config('session.table','sessions'))->where('user_id',$target->id);
                    if ($target->id === $request->user()->id) $sessions->where('id','!=',$request->session()->getId());
                    $sessions->delete();
                }
            }
            $target->save();
        });
        return redirect()->route('admin.users.index')->with('success','Cuenta y permisos actualizados correctamente.');
    }
}
