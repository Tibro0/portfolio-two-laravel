<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function () {
            return new SettingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingsService = $this->app->make(SettingsService::class);
        $settingsService->setGlobalSettings();
    }
}
