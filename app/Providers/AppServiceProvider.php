<?php

namespace App\Providers;

use App\Models\User\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Inertia Share
        Inertia::share("clients", function () {
            if (Auth::check()) {
                $user = auth()->user();
                $items = Client::where("user_id", $user->id)->get();
                return $items;
            } else {
                return null;
            }
        });
        
        // Sessions Variables
        Inertia::share("success_message", function () {
            return session()->get("success_message") ? session()->get("success_message") : null;
        });
        Inertia::share("info_message", function () {
            return session()->get("info_message") ? session()->get("info_message") : null;
        });
        Inertia::share("warning_message", function () {
            return session()->get("warning_message") ? session()->get("warning_message") : null;
        });
        Inertia::share("error_message", function () {
            return session()->get("error_message") ? session()->get("error_message") : null;
        });
        Inertia::share("primary_message", function () {
            return session()->get("primary_message") ? session()->get("primary_message") : null;
        });
        Inertia::share("dark_message", function () {
            return session()->get("dark_message") ? session()->get("dark_message") : null;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
