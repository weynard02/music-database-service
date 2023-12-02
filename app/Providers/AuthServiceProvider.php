<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return $user->plan->name == 'admin';
        });

        Gate::define('isPremium', function($user) {
            return $user->plan->name == 'premium';
        });

        Gate::define('isFree', function($user) {
            return $user->plan->name == 'free';
        });

        Gate::define('playlist-delete', function($user, $playlist){
            return $user->id == $playlist->user_id; 
        });
        Gate::define('playlist-create-free', function($user){
            return $user->plan->name == 'free' && count($user->playlists) >= 3; 
        });
    }
}
