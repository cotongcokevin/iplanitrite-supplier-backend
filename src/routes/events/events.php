<?php

declare(strict_types=1);

use App\Http\Controllers\EventController;

Route::group(['prefix' => 'events'], function () {

    Route::post(
        '/', [EventController::class, 'store']
    )->name('events.store');

    Route::group(['prefix' => '/{id}'], function() {
        Route::put(
            '/{id}/update-status', [EventController::class, 'updateStatus']
        )->name('events.update-status');
    });

});
