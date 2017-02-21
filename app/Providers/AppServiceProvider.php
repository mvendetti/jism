<?php

namespace App\Providers;

use App\CameraStatus;
use Illuminate\Support\Facades\Schema;
use App\Observers\CameraStatusObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        CameraStatus::observe(CameraStatusObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
