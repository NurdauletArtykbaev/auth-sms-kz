<?php

namespace NurdauletArtykbaev\CoreAuth\routes;

use Illuminate\Support\Facades\Route;
use NurdauletArtykbaev\CoreAuth\Http\Controllers\Api\AuthController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('otp', [AuthController::class, 'requestOtp'])->middleware(['throttle:5']);
    Route::post('refresh-token', [AuthController::class, 'refreshToken'])->middleware(['throttle:5', 'auth:sanctum']);
    Route::post('login', [AuthController::class, 'login'])->name('v2.login');
//    Route::post('register', [AuthController::class, 'register'])->middleware(['auth:sanctum']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
});
