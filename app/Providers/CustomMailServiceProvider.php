<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CustomMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $mailSetting = Cache::rememberForever('mail_settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        if ($mailSetting) {
            Config::set('app.name', $mailSetting['site_name']);
        }
    }
}
