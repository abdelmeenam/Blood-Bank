<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Role::class => RolePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
