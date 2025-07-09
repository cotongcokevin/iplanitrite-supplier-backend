<?php

declare(strict_types=1);

use App\Http\Middleware\AdminCors;
use App\Http\Middleware\OrganizerCors;
use App\Http\Middleware\ParticipantCors;

Route::group(['prefix' => 'admin'], function () {
    require __DIR__.'/admin/auth/auth.php';

    Route::group(['middleware' => 'auth:admin'], function () {
        require __DIR__.'/admin/admin/admin.php';
        require __DIR__.'/admin/profile/profile.php';
    });
})->middleware([AdminCors::class]);

Route::group(['prefix' => 'organizer'], function () {})->middleware([OrganizerCors::class]);

Route::group(['prefix' => 'participant'], function () {})->middleware([ParticipantCors::class]);
