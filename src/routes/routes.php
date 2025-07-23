<?php

declare(strict_types=1);

use App\Http\Middleware\AdminCors;
use App\Http\Middleware\ClientCors;
use App\Http\Middleware\SupplierCors;

Route::group(['prefix' => 'admin', 'middleware' => [AdminCors::class]], function () {
    require __DIR__.'/admin/auth/auth.php';

    Route::group(['middleware' => ['auth:ADMIN']], function () {
        require __DIR__.'/admin/admin/admin.php';
        require __DIR__.'/admin/suppliers/suppliers.php';
        require __DIR__.'/admin/profile/profile.php';
    });
});

Route::group([
    'prefix' => 'supplier',
    'middleware' => [SupplierCors::class],
], function () {
    require __DIR__.'/supplier/auth/auth.php';

    Route::group(['middleware' => ['auth:SUPPLIER_STAFF']], function () {
        require __DIR__.'/supplier/profile/profile.php';
    });
});

Route::group([
    'prefix' => 'client',
    'middleware' => [ClientCors::class],
], function () {
    require __DIR__.'/client/auth/auth.php';

    Route::group(['middleware' => ['auth:CLIENT']], function () {
        require __DIR__.'/client/profile/profile.php';
    });
});
