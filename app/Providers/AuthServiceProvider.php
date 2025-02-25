<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('admin-access', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('sales-access', function ($user) {
            return $user->role === 'sales';
        });
    }
}
