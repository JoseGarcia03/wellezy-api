<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function () {
    Route::get('/get-user', [AuthController::class, 'getUser']);
    // Route::get('/logout', [AuthController::class, 'logout']);
});
