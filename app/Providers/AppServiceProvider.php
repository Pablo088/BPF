<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fuerza HTTPS en el entorno local, por ejemplo, cuando usas Ngrok.
        if ($this->app->environment('local')) {
          //  URL::forceScheme('https');
        }
      //  if ($this->app->environment('local')) {
        //    URL::forceScheme('https');
        //}
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