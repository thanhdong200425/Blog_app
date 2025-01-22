<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('main.home', function ($view) {
            $user = Auth::user();
            $view->with('avatarSrc', $user->image_url ? $user->image_url : "https://picsum.photos/200/300");
        });
    }
}
