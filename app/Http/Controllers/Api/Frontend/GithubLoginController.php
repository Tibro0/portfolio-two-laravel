<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\AllApiCredentialController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class GithubLoginController extends Controller
{
    public function githubLogin()
    {
        AllApiCredentialController::githubApiSetting();

        // return Socialite::driver('github')->redirect();
        return response()->json([
            'status' => 200,
            'redirect_url' => Socialite::driver('github')->stateless()->redirect()->getTargetUrl(),
        ], 200);
    }

    public function githubCallback(Request $request)
    {
        AllApiCredentialController::githubApiSetting();

        $githubUser = Socialite::driver('github')->stateless()->user();

        $existingUser = User::where('email', $githubUser->email)->first();

        if ($existingUser) {
            $existingUser->update([
                'avatar' => $githubUser->avatar,
                'name' => $githubUser->name ?? $githubUser->nickname,
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);

            $user = $existingUser;
        } else {
            $user = User::create([
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
                'name' => $githubUser->name ?? $githubUser->nickname,
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'token' => $token,
            'name' => $user->name,
            'email' => $user->email,
            'id' => $user->id,
        ], 200);
    }
}
