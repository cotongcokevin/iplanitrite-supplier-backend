<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateChecklist;

use App\Data\Dto\Response\SupplierTemplateChecklistDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateChecklistModel
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

    public function toDto(): SupplierTemplateChecklistDto
    {
        return new SupplierTemplateChecklistDto(
            id: $this->id,
            description: $this->description,
            sortOrder: $this->sortOrder,
            supplierTemplateChecklistGroupId: $this->supplierTemplateChecklistGroupId,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }

    public function toEntity(): SupplierTemplateChecklistEntity
    {
        $entity = new SupplierTemplateChecklistEntity;
        $entity->id = (string) $this->id;
        $entity->description = $this->description;
        $entity->sort_order = $this->sortOrder;
        $entity->supplier_template_checklist_group_id = (string) $this->supplierTemplateChecklistGroupId;
        $entity->supplier_id = (string) $this->supplierId;
        $entity->created_by = (string) $this->createdBy;
        $entity->created_at = (string) $this->createdAt;
        $entity->updated_by = ((string) $this->updatedBy) ?: null;
        $entity->updated_at = ((string) $this->updatedAt) ?: null;

        return $entity;
    }
}
