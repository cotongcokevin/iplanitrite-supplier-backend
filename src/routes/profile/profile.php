<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;

Route::group(['prefix' => 'profile', 'middleware' => 'auth:api'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
});
