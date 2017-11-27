<?php

namespace Payfort;

use Illuminate\Support\ServiceProvider;

class PayfortServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      if(!file_exists(config_path('payfort.php'))){
        $this->publishes([
          __DIR__.'/../config/payfort.php' => config_path('payfort.php')
        ]);

        $this->publishes([
          __DIR__.'/../lang' => resource_path('lang'),
          __DIR__.'/../views' => resource_path('views'),
        ]);
      }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('PayFort', function ($app) {
        $pay = new PayFortClient();
        return $pay;
      });
    }

    /* public function provides() {
        return ['payfort'];
    }*/

}
