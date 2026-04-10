<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::pluck('value', 'key');
        return response()->json([
            'status' => 200,
            'data' => $setting,
        ], 200);
    }

    public function updateGeneralSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $validatedData = $validator->validated();

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();
        Cache::forget('mail_settings');

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!'
        ], 200);
    }

    public function updateMailSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_from_address' => 'required',
            'mail_receive_address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $validatedData = $validator->validated();

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!'
        ], 200);
    }

    public function updateGithubSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'github_client_id' => 'required',
            'github_client_secret' => 'required',
            'github_redirect_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $validatedData = $validator->validated();

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!'
        ], 200);
    }

    public function updateGoogleSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'google_client_id' => 'required',
            'google_client_secret' => 'required',
            'google_redirect_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $validatedData = $validator->validated();

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!'
        ], 200);
    }
}
