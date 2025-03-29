<?php

namespace Lopatin96\LaraLocale;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Lopatin96\LaraLocale\Services\LocaleService;

class LaraLocaleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/lara-locale.php', 'lara-locale'
        );

        Event::listen(Registered::class, static function ($event) {
            $event->user->forceFill([
                'locale' => (new LocaleService)->determineLocale(),
            ])->save();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/lara-locale.php' => config_path('lara-locale.php'),
        ], 'lara-locale-config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'lara-locale-migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'lara-locale');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/lara-locale'),
        ], 'lara-locale-lang');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lara-locale');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/lara-locale'),
        ], 'lara-locale-views');
    }
}
