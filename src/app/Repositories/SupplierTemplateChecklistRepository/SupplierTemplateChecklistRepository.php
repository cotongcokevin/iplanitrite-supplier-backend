<?php

declare(strict_types=1);

namespace App\Repositories\SupplierTemplateChecklistRepository;

use App\Classes\Principals\Principal;
use App\Models\SupplierTemplateChecklist\SupplierTemplateChecklistEntity;
use App\Models\SupplierTemplateChecklist\SupplierTemplateChecklistModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierTemplateChecklistRepository
{
    public function __construct(
        private Principal $principal
    ) {}

    /**
     * @param  UuidInterface[]  $ids
     * @return Collection<SupplierTemplateChecklistModel>
     */
    public function getByIds(UuidInterface $groupId, array $ids): Collection
    {
        return SupplierTemplateChecklistEntity::where('supplier_template_checklist_group_id', $groupId)
            ->whereIn('id', $ids)
            ->get()
            ->map(
                fn (SupplierTemplateChecklistEntity $entity) => ($entity->toModel())
            );
    }

    public function getLastChecklist(UuidInterface $groupId): ?SupplierTemplateChecklistModel
    {
        return SupplierTemplateChecklistEntity::where('supplier_template_checklist_group_id', $groupId)
            ->orderBy('sort_order', 'ASC')
            ->first()
            ?->toModel();
    }

    public function create(
        UuidInterface $groupId,
        string $description,
        int $sortOrder
    ): void {
        $entity = new SupplierTemplateChecklistEntity;
        $entity->id = Uuid::uuid4();
        $entity->description = $description;
        $entity->sort_order = $sortOrder;
        $entity->supplier_id = $this->principal::get()->guardId;
        $entity->supplier_template_checklist_group_id = $groupId;
        $entity->created_by = $this->principal::get()->id;
        $entity->created_at = Carbon::now();
        $entity->save();
    }

    public function update(
        UuidInterface $groupId,
        UuidInterface $id,
        string $description,
    ): void {
        $entity = SupplierTemplateChecklistEntity::where('id', $id)
            ->where('supplier_template_checklist_group_id', $groupId)
            ->first();
        $entity->description = $description;
        $entity->updated_by = $this->principal::get()->id;
        $entity->updated_at = Carbon::now();
        $entity->save();
    }

    /**
     * @param  SupplierTemplateChecklistEntity[]  $entities
     */
    public function sort(
        array $entities
    ): void {
        SupplierTemplateChecklistEntity::upsert(
            collect($entities)->map(
                fn (SupplierTemplateChecklistEntity $entity) => ($entity->toArray())
            )->toArray(),
            ['id']
        );
    }

    public function delete(
        UuidInterface $groupId,
        UuidInterface $id
    ): void {
        SupplierTemplateChecklistEntity::where('id', $id)
            ->where('supplier_template_checklist_group_id', $groupId)
            ->delete();
    }
}
