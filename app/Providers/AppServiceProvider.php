<?php

namespace App\Providers;

use App\Contract\ArticleRepositoryInterface;
use App\Contract\CommentRepositoryInterface;
use App\Contract\UserRepositoryInterface;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
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
