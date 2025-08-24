<?php

declare(strict_types=1);

use App\Http\Controllers\SupplierStaffController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'staff'], function () {
    Route::get('/', [SupplierStaffController::class, 'index'])->name('suppliers.staff.index');
});
