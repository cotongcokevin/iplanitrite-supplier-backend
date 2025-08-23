<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateChecklistGroup;

use App\Data\Dto\Response\SupplierTemplateChecklistGroupDto;
use App\Enums\EventType;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContext;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateChecklistGroupModel
{
    public function __construct(
        public UuidInterface $id,
        public SupplierTemplateChecklistGroupSection $section,
        public EventType $eventType,
        public SupplierTemplateChecklistGroupAccountableTo $accountableTo,
        public string $name,
        public int $sortOrder,
        public UuidInterface $supplierId,
        public UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    /**
     * @param  SupplierTemplateChecklistGroupContextType[]  $expectedContexts
     */
    public function toDto(
        ?SupplierTemplateChecklistGroupContext $context,
        array $expectedContexts
    ): SupplierTemplateChecklistGroupDto {
        return new SupplierTemplateChecklistGroupDto(
            id: $this->id,
            section: $this->section,
            eventType: $this->eventType,
            accountableTo: $this->accountableTo,
            name: $this->name,
            sortOrder: $this->sortOrder,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
            context: $context?->toDto($expectedContexts) ?: null
        );
    }
}
