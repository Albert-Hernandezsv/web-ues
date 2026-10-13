<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Support\PanelPermissions;

class AuthorizePanel
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->user()?->is_active, 403);
        $ability = PanelPermissions::forRoute($request->route()->getName());
        if ($ability !== null) Gate::authorize($ability);
        return $next($request);
    }
}
