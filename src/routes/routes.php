<?php

declare(strict_types=1);

Route::group(['prefix' => 'admin', 'middleware' => []], function () {
    require __DIR__.'/admin/auth/auth.php';

    Route::group(['middleware' => ['auth:ADMIN']], function () {
        require __DIR__.'/admin/admin/admin.php';
        require __DIR__.'/admin/suppliers/suppliers.php';
        require __DIR__.'/admin/profile/profile.php';
    });
});

Route::group([
    'prefix' => 'supplier',
    'middleware' => [],
], function () {
    require __DIR__.'/supplier/auth/auth.php';

    Route::group(['middleware' => ['auth:SUPPLIER_STAFF']], function () {
        require __DIR__.'/supplier/profile/profile.php';
        require __DIR__.'/supplier/event/event.php';
    });
});

Route::group([
    'prefix' => 'client',
    'middleware' => [],
], function () {
    require __DIR__.'/client/auth/auth.php';

    Route::group(['middleware' => ['auth:CLIENT']], function () {
        require __DIR__.'/client/profile/profile.php';
    });
});
