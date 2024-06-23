<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        //Role::class => RolePolicy::class,
    ];

    public function register()
    {
        parent::register();
        $this->app->bind('abilities', function () {
            return require base_path('data/abilities.php');
        });
    }

    public function boot()
    {
        $this->registerPolicies();
        foreach ($this->app->make('abilities') as $code) {
            Gate::define($code, function ($user) use ($code) {
                return $user->hasPermissionTo($code);
            });
        }
    }
}