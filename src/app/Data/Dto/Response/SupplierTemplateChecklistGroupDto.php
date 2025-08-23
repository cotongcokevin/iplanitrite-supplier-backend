<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateChecklistGroupDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public SupplierTemplateChecklistGroupSection $section,
        public SupplierTemplateChecklistGroupAccountableTo $accountableTo,
        public string $name,
        public int $sortOrder,
        public UuidInterface $supplierId,
        public UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?SupplierTemplateChecklistGroupContextDto $context = null
    ) {}
}
