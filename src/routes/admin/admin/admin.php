<?php

declare(strict_types=1);

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.admin.index');
    Route::get('/{id}', [AdminController::class, 'show'])->name('admin.admin.show');
    Route::post('/', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::put('{id}', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('{id}', [AdminController::class, 'destroy'])->name('admin.admin.destroy');
});
