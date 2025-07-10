<?php

declare(strict_types=1);

use App\Http\Middleware\AdminCors;
use App\Http\Middleware\OrganizerCors;
use App\Http\Middleware\ParticipantCors;

Route::group(['prefix' => 'admin', 'middleware' => [AdminCors::class]], function () {
    require __DIR__.'/admin/auth/auth.php';

    Route::group(['middleware' => ['auth:admin', AdminCors::class]], function () {
        require __DIR__.'/admin/admin/admin.php';
        require __DIR__.'/admin/profile/profile.php';
    });
});

Route::group([
    'prefix' => 'organizer',
    'middleware' => [OrganizerCors::class],
], function () {});

Route::group([
    'prefix' => 'participant',
    'middleware' => [ParticipantCors::class],
], function () {});
