<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierRoleDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public bool $immutable,
        public ?UuidInterface $supplierId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
