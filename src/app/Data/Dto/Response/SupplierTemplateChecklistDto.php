<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateChecklistDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $description,
        public int $sortOrder,
        public UuidInterface $supplierTemplateChecklistGroupId,
        public UuidInterface $supplierId,
        public UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}
}
