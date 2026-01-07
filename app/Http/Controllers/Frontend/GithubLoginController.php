<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class GithubLoginController extends Controller
{
    public function githubLogin()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
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
