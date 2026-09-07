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
