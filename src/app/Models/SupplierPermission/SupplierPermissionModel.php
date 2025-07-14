<?php

declare(strict_types=1);

namespace App\Models\SupplierPermission;

use App\Dto\Response\SupplierPermissionDto;
use App\Enums\SupplierPermissionType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierPermissionModel
{
    public function __construct(
        public UuidInterface $id,
        public SupplierPermissionType $name,
        public ?UuidInterface $supplierRoleId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): SupplierPermissionDto
    {
        return new SupplierPermissionDto(
            id: $this->id,
            name: $this->name,
            supplierRoleId: $this->supplierRoleId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
