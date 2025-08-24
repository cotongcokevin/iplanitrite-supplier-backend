<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth/auth.php';

Route::group(['middleware' => ['auth:SUPPLIER_STAFF']], function () {
    require __DIR__.'/templates/templates.php';
    require __DIR__.'/staff/staff.php';
});
