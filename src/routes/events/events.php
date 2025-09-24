<?php

declare(strict_types=1);

use App\Http\Controllers\EventController;

Route::group(['prefix' => 'events'], function () {

    Route::post(
        '/', [EventController::class, 'store']
    )->name('events.store');

});
