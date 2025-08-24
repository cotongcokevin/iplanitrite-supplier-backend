<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\SupplierStaff\SupplierStaffModel;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use Illuminate\Support\Collection;

readonly class SupplierStaffService
{
    public function __construct(private SupplierStaffRepository $supplierStaffRepository) {}

    /**
     * @return Collection<int, SupplierStaffModel>
     */
    public function search(): Collection
    {
        return $this->supplierStaffRepository->search();
    }
}
