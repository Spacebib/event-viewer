<?php

namespace Spacebib\EventViewer;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class EventViewerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->authorization();

        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetPublishing();
        $this->registerPublishing();
    }

    protected function authorization()
    {
        Gate::define('viewEventViewer', function ($user) {
            return in_array($user->email, config('event-viewer.accessEmails'));
        });

        EventViewer::auth(function ($request) {
            return app()->environment('local') ||
                Gate::check('viewEventViewer', [$request->user()]);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/event-viewer.php', 'event-viewer');

        $this->app->singleton(EventViewer::class, function ($app) {
            return new EventViewer();
        });
    }

    private function registerRoutes()
    {
        Route::group([
            'prefix' => config('event-viewer.path'),
            'namespace' => 'Spacebib\\EventViewer\\Http\\Controllers',
            'as' => 'event-viewer.',
            'middleware' => config('event-viewer.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        });
    }

    private function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'event-viewer');
    }

    public function defineAssetPublishing()
    {
        $this->publishes([
            realpath(__DIR__.'/../').'/public' => public_path('vendor/event-viewer'),
        ], ['event-viewer-assets']);
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
