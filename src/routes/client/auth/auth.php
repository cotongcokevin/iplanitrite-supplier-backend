<?php

declare(strict_types=1);

use App\Http\Controllers\Client\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('client.auth.login');

    Route::middleware('auth:CLIENT')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('client.auth.logout');
    });
});
