<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class GoogleLoginController extends Controller
{
    public function googleLogin()
    {
        AllApiCredentialController::googleApiSetting();

        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        AllApiCredentialController::googleApiSetting();

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
    }
}
