<?php

declare(strict_types=1);

use App\Http\Controllers\SupplierTemplateChecklistGroupController;
use App\Http\Controllers\SupplierTemplateChecklistController;

Route::group(['prefix' => 'templates'], function () {

    Route::group(['prefix' => 'checklist-groups'], function () {

        Route::group(['prefix' => '{id}/checklists'], function () {
            Route::post(
                '/', [SupplierTemplateChecklistController::class, 'store']
            )->name('templates.checklist-groups.checklists.index');

            Route::post(
                '/sort', [SupplierTemplateChecklistsController::class, 'sort']
            )->name('templates.checklist-groups.checklists.sort');

            Route::put(
                '/{checklistId}', [SupplierTemplateChecklistController::class, 'update']
            )->name('templates.checklist-groups.checklists.update');

            Route::delete(
                '/{checklistId}', [SupplierTemplateChecklistController::class, 'destroy']
            )->name('templates.checklist-groups.checklists.delete');
        });

        Route::get(
            '/{section}/{eventType}/{accountableTo}', [SupplierTemplateChecklistGroupController::class, 'index']
        )->name('templates.checklist-groups.index');

        Route::post(
            '/', [SupplierTemplateChecklistGroupController::class, 'store']
        )->name('templates.checklist-groups.store');

        Route::post(
            '/sort', [SupplierTemplateChecklistGroupsController::class, 'sort']
        )->name('templates.checklist-groups.sort');

        Route::put(
            '/{checklistId}', [SupplierTemplateChecklistGroupController::class, 'update']
        )->name('templates.checklist-groups.update');

        Route::delete(
            '/{checklistId}', [SupplierTemplateChecklistGroupController::class, 'destroy']
        )->name('templates.checklist-groups.destroy');

    });

});
