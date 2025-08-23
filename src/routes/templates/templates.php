<?php

declare(strict_types=1);

use App\Http\Controllers\SupplierTemplateChecklistGroupsController;

Route::group(['prefix' => 'templates'], function () {

    Route::group(['prefix' => 'checklist-groups'], function () {

        Route::get(
            '/{section}/{accountableTo}', [SupplierTemplateChecklistGroupsController::class, 'index']
        )->name('templates.checklist-groups.index');

        Route::post(
            '/', [SupplierTemplateChecklistGroupsController::class, 'store']
        )->name('templates.checklist-groups.store');

        Route::put(
            '/{checklistId}', [SupplierTemplateChecklistGroupsController::class, 'update']
        )->name('templates.checklist-groups.update');

        Route::delete(
            '/{checklistId}', [SupplierTemplateChecklistGroupsController::class, 'destroy']
        )->name('templates.checklist-groups.destroy');

    });

});
