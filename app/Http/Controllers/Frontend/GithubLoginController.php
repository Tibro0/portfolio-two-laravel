<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Socialite;

class GithubLoginController extends Controller
{
    public static function githubApiSetting()
    {
        $githubSetting = Setting::pluck('value', 'key')->toArray();

        Config::set('services.github.client_id', $githubSetting['github_client_id']);
        Config::set('services.github.client_secret', $githubSetting['github_client_secret']);
        Config::set('services.github.redirect', $githubSetting['github_redirect_url']);
    }

    public function githubLogin()
    {
        $this->githubApiSetting();

        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $this->githubApiSetting();

        $githubUser = Socialite::driver('github')->user();

        $existingUser = User::where('email', $githubUser->email)->first();

        if ($existingUser) {
            $existingUser->update([
                'avatar' => $githubUser->avatar,
                'name' => $githubUser->name,
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);

            $user = $existingUser;
        } else {
            $user = User::create([
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
                'name' => $githubUser->name,
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);
        }

        Auth::login($user, true);
        return redirect()->route('admin.dashboard');
    }
}
