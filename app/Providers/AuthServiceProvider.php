<?php

namespace App\Providers;

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

        Gate::define('view-moderators', function (User $user, User $userProfile) {
            return $user->isAdmin() || $user->id === $userProfile->id;
        });

        Gate::define('manage-moderators', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-job-locations', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-employees', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
    }
}
