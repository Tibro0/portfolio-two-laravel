<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::pluck('value', 'key');
        return view('admin.setting.index', compact('setting'));
    }

    public function updateGeneralSetting(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => ['required', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }

    public function updateMailSetting(Request $request)
    {
        $validatedData = $request->validate([
            'mail_driver' => ['required'],
            'mail_host' => ['required'],
            'mail_port' => ['required'],
            'mail_username' => ['required'],
            'mail_password' => ['required'],
            'mail_from_address' => ['required'],
            'mail_receive_address' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();
        Cache::forget('mail_settings');

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }
}
