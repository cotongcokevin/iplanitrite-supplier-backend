<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::post('/', [ProfileController::class, 'update'])->name('admin.profile.update');
});
