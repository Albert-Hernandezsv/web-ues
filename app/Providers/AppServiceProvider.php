<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach (\App\Support\PanelPermissions::all() as $permission) {
            \Illuminate\Support\Facades\Gate::define($permission, fn (\App\Models\User $user) => $user->hasPermission($permission));
        }
        \Illuminate\Support\Facades\Gate::define('users.manage', fn (\App\Models\User $user) => $user->is_active && $user->role === 'admin');
        \Illuminate\Support\Facades\Gate::define('pages.access', function (\App\Models\User $user) {
            foreach (\App\Support\PanelPermissions::all() as $permission) {
                if (str_starts_with($permission, 'pages.') && $user->hasPermission($permission)) return true;
            }
            return false;
        });
        \Illuminate\Support\Facades\Gate::define('deny', fn () => false);

        View::composer('*', function ($view) {
            $menuPages = Page::query()
                ->where('status', true)
                ->where('show_in_menu', true)
                ->orderBy('menu_order')
                ->get();

            $view->with('menuPages', $menuPages);
        });
    }
}
