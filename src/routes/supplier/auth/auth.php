<?php

declare(strict_types=1);

use App\Http\Controllers\Supplier\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('supplier.auth.login');

    Route::middleware('auth:SUPPLIER_STAFF')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('supplier.auth.logout');
    });
});
