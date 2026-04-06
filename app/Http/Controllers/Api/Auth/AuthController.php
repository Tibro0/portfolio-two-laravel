<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // this will return validator errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);

            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'token' => $token,
                'name' => $user->name,
                'id' => Auth::user()->id,
            ], 200);
        } elseif (!User::where(['email' => $request->email])->exists()) {
            return response()->json([
                'status' => 401,
                'message' => 'Your Email is Incorrect.',
            ], 401);
        } elseif (!User::where(['password' => $request->password])->exists()) {
            return response()->json([
                'status' => 401,
                'message' => 'Your Password is Incorrect.',
            ], 401);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'These credentials do not match our records.',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully Logged Out',
        ]);
    }
}
