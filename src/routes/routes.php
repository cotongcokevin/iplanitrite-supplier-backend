<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth/auth.php';

Route::group(['middleware' => ['auth:SUPPLIER']], function () {

});