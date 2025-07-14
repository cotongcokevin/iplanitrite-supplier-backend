<?php

declare(strict_types=1);

use App\Http\Controllers\Supplier\ProfileController;

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('supplier.profile.index');
    Route::post('/', [ProfileController::class, 'update'])->name('supplier.profile.update');
});
