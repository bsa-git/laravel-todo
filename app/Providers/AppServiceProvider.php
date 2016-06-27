<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DripEmailer;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        // Set locale for Carbon
        Carbon::setLocale(config('app.locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('App\Services\DripEmailer', function ($app) {
            return new DripEmailer($app);
        });
    }

}
