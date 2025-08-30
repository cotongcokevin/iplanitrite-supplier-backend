<?php

declare(strict_types=1);

use App\Http\Controllers\SupplierTemplateChecklistGroupsController;
use App\Http\Controllers\SupplierTemplateChecklistsController;
use App\Http\Controllers\SupplierTemplateTimelineController;

Route::group(['prefix' => 'templates'], function () {

    Route::group(['prefix' => 'checklist-groups'], function () {

        Route::group(['prefix' => '{id}/checklists'], function () {
            Route::post(
                '/', [SupplierTemplateChecklistsController::class, 'store']
            )->name('templates.checklist-groups.checklists.index');

            Route::post(
                '/sort', [SupplierTemplateChecklistsController::class, 'sort']
            )->name('templates.checklist-groups.checklists.sort');

            Route::put(
                '/{checklistId}', [SupplierTemplateChecklistsController::class, 'update']
            )->name('templates.checklist-groups.checklists.update');

            Route::delete(
                '/{checklistId}', [SupplierTemplateChecklistsController::class, 'destroy']
            )->name('templates.checklist-groups.checklists.delete');
        });

        Route::get(
            '/{section}/{eventType}/{accountableTo}', [SupplierTemplateChecklistGroupsController::class, 'index']
        )->name('templates.checklist-groups.index');

        Route::post(
            '/', [SupplierTemplateChecklistGroupsController::class, 'store']
        )->name('templates.checklist-groups.store');

        Route::post(
            '/sort', [SupplierTemplateChecklistGroupsController::class, 'sort']
        )->name('templates.checklist-groups.sort');

        Route::put(
            '/{checklistId}', [SupplierTemplateChecklistGroupsController::class, 'update']
        )->name('templates.checklist-groups.update');

        Route::delete(
            '/{checklistId}', [SupplierTemplateChecklistGroupsController::class, 'destroy']
        )->name('templates.checklist-groups.destroy');

    });

    Route::group(['prefix' => 'timelines'], function () {
        Route::get(
            '/{eventType}', [SupplierTemplateTimelineController::class, 'index']
        )->name('templates.timeline.index');

        Route::post(
            '/', [SupplierTemplateTimelineController::class, 'store']
        )->name('templates.timeline.store');

        Route::put(
            '/{id}', [SupplierTemplateTimelineController::class, 'update']
        )->name('templates.timeline.update');

        Route::delete(
            '/{id}', [SupplierTemplateTimelineController::class, 'destroy']
        )->name('templates.timeline.update');
    });

});
