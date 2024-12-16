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
        // for middleware guest, if already logged in, redirected to designated home route based on user's role
        \Illuminate\Auth\Middleware\RedirectIfAuthenticated::redirectUsing(function($request) {
            if (auth()->user()->role === 'admin') {
                return route('admin.dashboard');
            }
            return route('user.home');
        });        
    }
}
