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

        Gate::define('edit-admins', function (User $user, User $admin) {
            return $user->isAdmin() || $user->id === $admin->id;
        });

        Gate::define('edit-moderators', function (User $user, User $moderator) {
            return $user->isAdmin() || $user->id === $moderator->id;
        });

        Gate::define('manage-moderators', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-job-locations', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-job-shifts', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-employees-salary', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-employees', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
    }
}
