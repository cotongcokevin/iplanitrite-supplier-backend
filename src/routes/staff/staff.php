<?php

declare(strict_types=1);

use App\Http\Controllers\SupplierStaffController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'staff'], function () {
    Route::get('/', [SupplierStaffController::class, 'index'])->name('suppliers.staff.index');
    Route::get('/{id}', [SupplierStaffController::class, 'show'])->name('suppliers.staff.show');
    Route::post('/', [SupplierStaffController::class, 'store'])->name('suppliers.staff.store');
    Route::put('/{id}', [SupplierStaffController::class, 'update'])->name('suppliers.staff.update');
    Route::delete('/{id}', [SupplierStaffController::class, 'destroy'])->name('suppliers.staff.destroy');
});
