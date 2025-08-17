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
