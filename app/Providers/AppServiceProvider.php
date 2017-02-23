<?php

namespace App\Providers;

use App\Camera;
use App\CameraStatus;
use App\Observers\CameraObserver;
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
        Camera::observe(CameraObserver::class);
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
