<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminSupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'suppliers'], function () {
    Route::get('/', [AdminSupplierController::class, 'index'])->name('admin.suppliers.index');
    Route::get('/{id}', [AdminSupplierController::class, 'show'])->name('admin.suppliers.show');
    Route::post('/', [AdminSupplierController::class, 'store'])->name('admin.suppliers.store');
    Route::put('{id}', [AdminSupplierController::class, 'update'])->name('admin.suppliers.update');
    Route::delete('{id}', [AdminSupplierController::class, 'destroy'])->name('admin.suppliers.destroy');
});
