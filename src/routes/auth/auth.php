<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post("login", [AuthController::class, "login"]);
});


Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
});