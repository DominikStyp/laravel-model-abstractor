<?php

namespace DominikStyp\LaravelModelAbstractor;

use Illuminate\Support\ServiceProvider;
class LaravelModelAbstractorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
           __DIR__.'/publish/Console' => app_path('/Console'),
           __DIR__.'/publish/Models' => app_path('/Models'),
        ]);
        $this->commands([
            \DominikStyp\LaravelModelAbstractor\Console\Commands\ListModels::class,
            \DominikStyp\LaravelModelAbstractor\Console\Commands\ChangeModelsInheritance::class
        ]); 
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
    
}
