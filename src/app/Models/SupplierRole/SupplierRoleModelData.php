<?php

declare(strict_types=1);

namespace App\Models\SupplierRole;

use App\Dto\Response\SupplierRoleDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierRoleModelData
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

    public function toDto(): SupplierRoleDto
    {
        return new SupplierRoleDto(
            id: $this->id,
            name: $this->name,
            immutable: $this->immutable,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
