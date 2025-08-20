<?php

declare(strict_types=1);

require __DIR__.'/auth/auth.php';

Route::group(['middleware' => ['auth:SUPPLIER']], function () {
});