<?php

declare(strict_types=1);

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'suppliers'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('admin.suppliers.index');
    Route::get('/{id}', [SupplierController::class, 'show'])->name('admin.suppliers.show');
    Route::post('/', [SupplierController::class, 'store'])->name('admin.suppliers.store');
    Route::put('{id}', [SupplierController::class, 'update'])->name('admin.suppliers.update');
    Route::delete('{id}', [SupplierController::class, 'destroy'])->name('admin.suppliers.destroy');
});
