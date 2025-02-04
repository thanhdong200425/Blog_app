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
            $view->with([
                'avatarSrc' => $user ? $user->image_url : null,
                'userName' => $user ? "{$user->first_name} {$user->last_name}" : null,
            ]);

        });
    }
}
