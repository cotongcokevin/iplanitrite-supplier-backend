<?php

declare(strict_types=1);

namespace App\Repositories\SupplierRepository\Data;

class SupplierRepositoryUpdateData
{
    public function __construct(
        public string $name,
        public string $description,
        public int $maxStaff
    ) {}
}
