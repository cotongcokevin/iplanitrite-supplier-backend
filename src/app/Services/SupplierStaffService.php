<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use Illuminate\Support\Collection;

readonly class SupplierStaffService
{
    public function __construct(private SupplierStaffRepository $supplierStaffRepository) {}

    public function searchWithContext(array $contexts): Collection
    {
        return $this->supplierStaffRepository->searchWithContext($contexts);
    }
}
