<?php

declare(strict_types=1);

use App\Http\Controllers\Supplier\EventController;

Route::group(['prefix' => 'event'], function () {
    Route::get('/', [EventController::class, 'index'])->name('supplier.event.index');
    Route::post('/', [EventController::class, 'store'])->name('supplier.event.store');
});
