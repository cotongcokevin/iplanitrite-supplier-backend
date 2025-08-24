<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\SupplierStaff\SupplierStaffModel;
use App\Services\SupplierStaffService;
use Illuminate\Http\JsonResponse;

class SupplierStaffController
{
    public function index(SupplierStaffService $service): JsonResponse
    {
        return transaction(function () use ($service) {
            $result = $service->search();

            return $result->map(function (SupplierStaffModel $model) {
                return $model->toDto();
            });
        });
    }
}
