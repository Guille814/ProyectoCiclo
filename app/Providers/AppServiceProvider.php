<?php

namespace App\Providers;

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
        //
    }
    protected $listen = [
        'App\Events\UserFollowed' => [
            'App\Listeners\SendUserFollowedNotification',
        ],
        'App\Events\PostCommented' => [
            'App\Listeners\SendPostCommentedNotification',
        ],
        'App\Events\PostLiked' => [
            'App\Listeners\SendPostLikedNotification',
        ],
    ];
}
