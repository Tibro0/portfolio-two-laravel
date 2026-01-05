<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingsService
{
    public function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    /** set all value Global */
    public function setGlobalSettings()
    {
        $settings = $this->getSettings();
        Config::set('settings', $settings);
    }

    /** Clear Cache */
    public function clearCachedSettings()
    {
        Cache::forget('settings');
    }
}
