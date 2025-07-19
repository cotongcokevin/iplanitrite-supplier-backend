<?php

declare(strict_types=1);

namespace App\Repositories\SupplierRepository\Data;

use Ramsey\Uuid\UuidInterface;

class SupplierRepositoryStoreData
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $description,
        public int $maxStaff
    ) {}
}
