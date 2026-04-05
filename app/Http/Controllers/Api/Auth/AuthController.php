<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // this will return validator errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);

            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'name' => $user->name,
                'id' => Auth::user()->id,
            ]);
        } elseif (!User::where(['email' => $request->email])->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Your Email is Incorrect.',
            ]);
        } elseif (!User::where(['password' => $request->password])->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Your Password is Incorrect.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'These credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully Logged Out',
        ]);
    }
}
