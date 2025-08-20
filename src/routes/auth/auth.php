<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('admin.auth.login');

    Route::middleware('auth:ADMIN')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    });
});
