<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\DummyEntrepreneur;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('app', function ($view) {
            $hasEntrepreneurEntry = false;
            if (Auth::check()) {
                $userId = Auth::id();
                $entrepreneur = DummyEntrepreneur::where('user_id', $userId)->first();
                if ($entrepreneur) {
                    $completedSteps = $entrepreneur->completed_steps ? json_decode($entrepreneur->completed_steps, true) : [];
                    $hasEntrepreneurEntry = true;
                }
            }
            $view->with('hasEntrepreneurEntry', $hasEntrepreneurEntry);
        });
    }
}