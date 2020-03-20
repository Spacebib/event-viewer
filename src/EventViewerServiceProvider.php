<?php

namespace Spacebib\EventViewer;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class EventViewerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->registerPublishing();
    }

    public function register()
    {
        $this->app->singleton(EventViewer::class, function ($app) {
            return new EventViewer($this->app);
        });
    }

    private function registerRoutes()
    {
        Route::group([
            'prefix' => config('event-viewer.path'),
            'namespace' => 'Spacebib\\EventViewer\\Controllers',
            'as' => 'event-viewer.',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        });
    }

    private function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'event-viewer');
    }

    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/event-viewer.php' => $this->app->configPath('/event-viewer.php')
            ], 'event-viewer-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/event-viewer'),
            ], 'event-viewer-views');
        }
    }
}
