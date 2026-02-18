<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Socialite;

class GoogleLoginController extends Controller
{
    public static function googleApiSetting()
    {
        $googleSetting = Setting::pluck('value', 'key')->toArray();

        Config::set('services.google.client_id', $googleSetting['google_client_id']);
        Config::set('services.google.client_secret', $googleSetting['google_client_secret']);
        Config::set('services.google.redirect', $googleSetting['google_redirect_url']);
    }

    public function googleLogin()
    {
        $this->googleApiSetting();

        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $this->googleApiSetting();

        $googleUser = Socialite::driver('google')->user();

        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            $existingUser->update([
                'avatar' => $googleUser->avatar,
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            $user = $existingUser;
        } else {
            $user = User::create([
                'email' => $googleUser->email,
                'avatar' => $googleUser->avatar,
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        }

        Auth::login($user, true);
        return redirect()->route('admin.dashboard');

        // $googleUser = Socialite::driver('google')->user();

        // $user = User::updateOrCreate([
        //     'google_id' => $googleUser->id,
        //     'email' => $googleUser->email,
        // ], [
        //     'avatar' => $googleUser->avatar,
        //     'name' => $googleUser->name,
        //     'google_token' => $googleUser->token,
        //     'google_refresh_token' => $googleUser->refreshToken,
        // ]);

        // Auth::login($user, true);

        // return redirect()->route('admin.dashboard');
    }
}
