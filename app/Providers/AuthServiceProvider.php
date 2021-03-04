<?php

namespace App\Providers;

use App\Models\Annoucement;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-vehicle', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('enabled-comment', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('enabled-annoucement', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('his-annoucement', function (User $user, Annoucement $annoucement) {

            return $user->id === $annoucement->user_id ;
        });

        Gate::define('his-comment', function (User $user, Comment $comment) {

            return $user->id === $comment->user_id ;
        });
    }
}
