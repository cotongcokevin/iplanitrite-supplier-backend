<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use Illuminate\Support\Collection;

readonly class SupplierStaffService
{
    public function __construct(private SupplierStaffRepository $supplierStaffRepository) {}

    /**
     * @param array $contexts
     * @return Collection
     */
    public function searchWithContext(array $contexts): Collection
    {
        return $this->supplierStaffRepository->searchWithContext($contexts);
    }
}
