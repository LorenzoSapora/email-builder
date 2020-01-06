<?php

namespace LorenzoSapora\EmailBuilder;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use LorenzoSapora\EmailBuilder\Commands\CreateLayout;
use LorenzoSapora\EmailBuilder\Commands\CreatePreset;
use LorenzoSapora\EmailBuilder\Commands\CreateResolver;
use LorenzoSapora\EmailBuilder\Http\Middleware\InterceptFlexibleAttributes;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['router']->pushMiddlewareToGroup('nova', InterceptFlexibleAttributes::class);
        
        Nova::serving(function (ServingNova $event) {
            Nova::script('email-builder', __DIR__.'/../dist/js/field.js');
            Nova::style('email-builder', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->runningInConsole()) return;

        $this->commands([
            CreateLayout::class,
            CreatePreset::class,
            CreateResolver::class,
        ]);
    }
}
