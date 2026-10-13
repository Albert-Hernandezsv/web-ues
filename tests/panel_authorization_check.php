<?php
require __DIR__.'/../vendor/autoload.php';
$app=require __DIR__.'/../bootstrap/app.php';
$kernel=$app->make(Illuminate\Contracts\Http\Kernel::class);
$app->instance('request', Illuminate\Http\Request::create('/'));
$kernel->bootstrap();
$app['env']='testing';
config(['database.default'=>'sqlite','database.connections.sqlite.database'=>':memory:','session.driver'=>'array','cache.default'=>'array','app.env'=>'testing','app.debug'=>true,'view.compiled'=>sys_get_temp_dir().'/ues-rbac-compiled']);
if(!is_dir(config('view.compiled')))mkdir(config('view.compiled'));
Illuminate\Support\Facades\DB::purge('sqlite');
Illuminate\Support\Facades\Artisan::call('migrate',['--force'=>true]);
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Support\PanelPermissions;
$count=0;
function check($condition,$message){global $count;if(!$condition)throw new RuntimeException($message);$count++;}
$admin=(new User())->forceFill(['name'=>'Admin','email'=>'admin@test.example','password'=>'Secret-password-123','role'=>'admin','is_active'=>true,'permissions'=>[]]);$admin->save();$admin->refresh();
$editor=(new User())->forceFill(['name'=>'Editor','email'=>'editor@test.example','password'=>'Secret-password-123','role'=>'editor','is_active'=>true,'permissions'=>[]]);$editor->save();$editor->refresh();
foreach(PanelPermissions::all() as $permission){check(Gate::forUser($admin)->allows($permission),'Admin denied '.$permission);check(!Gate::forUser($editor)->allows($permission),'Editor allowed '.$permission);}
check(!Gate::forUser($editor)->allows('users.manage'),'Editor can manage users');
function requestAs($user,$method,$uri,$data=[]){global $kernel;app('session')->driver()->flush();Auth::forgetGuards();Auth::guard()->setUser($user->fresh());$r=Illuminate\Http\Request::create($uri,$method,$data,[],[],['HTTP_ACCEPT'=>'application/json']);$response=$kernel->handle($r);return $response;}
foreach(['/gestionar-usuarios','/gestionar-usuarios/create','/gestionar-usuarios/'.$admin->id.'/edit','/admin/noticias','/admin/alumnis','/admin/galeria','/admin/descargas','/gestionar-paginas-base/inicio'] as $uri){$r=requestAs($editor,'GET',$uri);check($r->getStatusCode()===403,'Expected 403 '.$uri.' got '.$r->getStatusCode().' '.$r->getContent());}
$payload=['name'=>'New editor','email'=>'new@test.example','password'=>'Another-secret-123','password_confirmation'=>'Another-secret-123','role'=>'editor','is_active'=>1,'permissions'=>['news.create','news.edit']];
$r=requestAs($editor,'POST','/gestionar-usuarios',$payload);check($r->getStatusCode()===403,'Editor can create users');
$r=requestAs($admin,'POST','/gestionar-usuarios',$payload);check($r->getStatusCode()===302,'Admin create failed '.$r->getContent());
$new=User::where('email','new@test.example')->firstOrFail();check(Illuminate\Support\Facades\Hash::check($payload['password'],$new->password),'Password not hashed');check($new->hasPermission('news.view'),'Implicit view missing');
check(!$new->hasPermission('news.publish'),'Unexpected publish permission');
$r=requestAs($new,'POST','/admin/noticias',['title'=>'Draft','status'=>0]);check($r->getStatusCode()===302,'Draft rejected '.$r->getContent());
$r=requestAs($new,'POST','/admin/noticias',['title'=>'Unauthorized publish','status'=>1]);check($r->getStatusCode()===403,'Publication bypass');
$news=App\Models\News::create(['title'=>'Live','slug'=>'live','status'=>1,'published_at'=>'2020-01-01']);
$r=requestAs($new,'PUT','/admin/noticias/'.$news->id,['title'=>'Tampered','status'=>0]);check($r->getStatusCode()===403,'Live content tampering allowed');
$payload=['name'=>'Admin','email'=>$admin->email,'role'=>'editor','is_active'=>1];
$r=requestAs($admin,'PUT','/gestionar-usuarios/'.$admin->id,$payload);check($r->getStatusCode()===422,'Last admin demotion allowed '.$r->getContent());
$payload['role']='admin';$payload['is_active']=0;$r=requestAs($admin,'PUT','/gestionar-usuarios/'.$admin->id,$payload);check($r->getStatusCode()===422,'Last admin deactivation allowed');
$r=requestAs($editor,'PATCH','/gestionar-usuario',['name'=>'Editor','email'=>$editor->email,'role'=>'admin','permissions'=>['news.publish'],'is_active'=>1]);check($r->getStatusCode()===302,'Profile failed '.$r->getContent());check($editor->fresh()->role==='editor','Profile privilege escalation');
$payload=['name'=>$new->name,'email'=>$new->email,'role'=>'editor','is_active'=>0,'permissions'=>[]];$r=requestAs($admin,'PUT','/gestionar-usuarios/'.$new->id,$payload);check($r->getStatusCode()===302,'Deactivation failed');
$r=requestAs($new,'GET','/dashboard');check($r->getStatusCode()===302,'Inactive session not blocked');
foreach(['/gestionar-usuarios','/gestionar-usuarios/create','/gestionar-usuarios/'.$editor->id.'/edit','/dashboard'] as $uri){$r=requestAs($admin,'GET',$uri);check($r->getStatusCode()===200,'Admin page failed '.$uri.' '.$r->getContent());}
$editor->forceFill(['permissions'=>['news.view']])->save();
$r=requestAs($editor,'GET','/admin/noticias/'.$news->id.'/edit');check($r->getStatusCode()===200 && str_contains($r->getContent(),'fieldset disabled'),'Read-only view is not disabled');
$r=requestAs($editor,'PUT','/admin/noticias/'.$news->id,['title'=>'Forbidden','status'=>0]);check($r->getStatusCode()===403,'Read-only user can update');
$r=requestAs($editor,'DELETE','/admin/noticias/'.$news->id);check($r->getStatusCode()===403,'Read-only user can delete');
$r=requestAs($editor,'PUT','/gestionar-usuarios/'.$admin->id,['name'=>'Tampered','email'=>$admin->email,'role'=>'editor','is_active'=>0]);check($r->getStatusCode()===403,'Editor can change another account');
$r=requestAs($admin,'POST','/gestionar-usuarios',['name'=>'Invalid','email'=>'invalid@test.example','password'=>'Secret-password-123','password_confirmation'=>'Secret-password-123','role'=>'editor','is_active'=>1,'permissions'=>['users.manage']]);check($r->getStatusCode()===422,'Unknown permission accepted');
$r=requestAs($admin,'PUT','/gestionar-usuarios/'.$editor->id,['name'=>'Editor renamed','email'=>$editor->email,'role'=>'editor','is_active'=>1,'permissions'=>['gallery.view']]);check($r->getStatusCode()===302,'Account update failed');
check($editor->fresh()->name==='Editor renamed' && $admin->fresh()->name==='Admin','Edited wrong account');
check(!$editor->fresh()->hasPermission('news.view') && $editor->fresh()->hasPermission('gallery.view'),'Permission replacement failed');
Auth::forgetGuards();app('session')->driver()->flush();
$r=$kernel->handle(Illuminate\Http\Request::create('/login','POST',['email'=>$new->email,'password'=>'Another-secret-123'],[],[],['HTTP_ACCEPT'=>'application/json']));
check($r->getStatusCode()===422,'Inactive account can log in');
foreach(app('router')->getRoutes() as $route){if(in_array('panel.access',$route->middleware()))check(PanelPermissions::forRoute($route->getName())!=='deny','Unmapped route '.$route->getName());}
echo "PASS $count authorization, user management, publication and rendering checks. SQLite only.\n";
