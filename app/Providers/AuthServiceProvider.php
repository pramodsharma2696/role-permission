<?php

namespace App\Providers;

use App\Policies\RolePolicy;
use Spatie\Permission\Models\Role;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     protected $policies = [
            Role::class => RolePolicy::class,
        ];


    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
