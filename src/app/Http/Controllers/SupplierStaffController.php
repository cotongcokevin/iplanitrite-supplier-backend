<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Pair;
use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Models\SupplierStaff\Context\SupplierStaffContextType;
use App\Models\SupplierStaff\SupplierStaffModel;
use App\Services\SupplierStaffService;
use Illuminate\Http\JsonResponse;

class SupplierStaffController
{
    /**
     * @param SupplierStaffService $service
     * @return JsonResponse
     * @throws SupplierStaffContextException
     */
    public function index(SupplierStaffService $service): JsonResponse
    {
        $contexts = [SupplierStaffContextType::CONTACT_NUMBER,SupplierStaffContextType::ADDRESS];
        return transaction(function () use ($service, $contexts) {
            return $service->searchWithContext($contexts)->map(function (Pair $result) use ($contexts) {
                /** @var SupplierStaffModel $model */
                $model = $result->first;
                return $model->toDto($result->second, $contexts);
            });
        });

    }
}
