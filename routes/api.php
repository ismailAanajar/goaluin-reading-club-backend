<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function() {
    Route::middleware('guest')->group(function() {
        Route::post('auth/login', [AuthController::class, 'login']);
        Route::post('auth/register', [AuthController::class, 'register']);
    });

     Route::middleware('auth:sanctum')->group(function () {
      Route::post('auth/logout', [Auth::class, 'logout']);
      Route::get('profile', [AuthController::class, 'profile']);
      Route::post('/post/create', [PostController::class, 'create']);
    });

});