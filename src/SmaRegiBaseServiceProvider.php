<?php

namespace Arcplg\Smaregi;

use Arcplg\Smaregi\Features\Stocks;
use Arcplg\Smaregi\Features\Products;
use Illuminate\Support\ServiceProvider;
use Arcplg\Smaregi\Features\Authorization;



class SmaRegiBaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/smaregi.php',
            'smaregi'
        );
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/smaregi.php' => config_path('smaregi.php'),
        ], 'arcplg-smaregi-config');
    }
}
