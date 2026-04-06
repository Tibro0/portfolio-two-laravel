<?php

use App\Http\Controllers\Api\Admin\AnimationTextController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
    });

    Route::prefix('admin')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'index');
            Route::post('profile', 'updateProfile');
            Route::post('profile/password', 'updatePassword');
        });

        /** Animation Text All Route */
        Route::controller(AnimationTextController::class)->group(function () {
            Route::get('animation-text', 'index');
            Route::post('animation-text/store', 'store');
            Route::get('animation-text/{id}', 'show');
            Route::put('animation-text/{id}', 'update');
            Route::delete('animation-text/{id}', 'destroy');
        });

    });
});
