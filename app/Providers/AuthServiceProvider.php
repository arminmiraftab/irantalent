<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => 'App\Policies\AuthenticationPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }
//        Gate::define('login-in',function($users){
//            return $users==2;
//        });
        Gate::define('basic',function($user){
            return $user->hasAnyRoles('basic');
        });
        Gate::define('intermediate',function($user){
            return $user->hasAnyRoles('intermediate');
        });
        Gate::define('advance',function($user){
            return $user->hasAnyRoles('advance');
        });
    }
}
