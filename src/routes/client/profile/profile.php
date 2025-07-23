<?php

declare(strict_types=1);

use App\Http\Controllers\Client\ProfileController;

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('client.profile.index');
    Route::post('/', [ProfileController::class, 'update'])->name('client.profile.update');
});
