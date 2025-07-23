<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Enums\SupplierPermissionType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierPermissionDto extends ResponseDto
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
}
