<?php

declare(strict_types=1);

namespace App\Repositories\SupplierTemplateChecklistGroupRepository;

use App\Classes\Pair;
use App\Classes\Principals\Principal;
use App\Enums\EventType;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContext;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextType;
use App\Models\SupplierTemplateChecklistGroup\SupplierTemplateChecklistGroupEntity;
use App\Models\SupplierTemplateChecklistGroup\SupplierTemplateChecklistGroupModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierTemplateChecklistGroupRepository
{
    public function __construct(private Principal $principal) {}

    public function getLast(
        SupplierTemplateChecklistGroupSection $section,
        SupplierTemplateChecklistGroupAccountableTo $accountableTo,
    ): ?SupplierTemplateChecklistGroupModel {
        return SupplierTemplateChecklistGroupEntity::where('section', $section)
            ->where('accountable_to', $accountableTo)
            ->orderBy('sort_order', 'DESC')
            ->first()
            ?->toModel();
    }

    /**
     * @param  SupplierTemplateChecklistGroupContextType[]  $contexts
     * @return Collection<Pair<SupplierTemplateChecklistGroupModel, SupplierTemplateChecklistGroupContext>>
     */
    public function getWithContext(
        SupplierTemplateChecklistGroupSection $section,
        EventType $eventType,
        SupplierTemplateChecklistGroupAccountableTo $accountableTo,
        array $contexts
    ): Collection {
        $result = SupplierTemplateChecklistGroupEntity::where('section', $section)
            ->where('event_type', $eventType)
            ->where('accountable_to', $accountableTo)
            ->orderBy('sort_order', 'ASC')
            ->get();

        return $result->map(function (SupplierTemplateChecklistGroupEntity $entity) use ($contexts) {
            return new Pair(
                $entity->toModel(),
                $entity->buildContext($contexts)
            );
        });
    }

    public function create(
        string $name,
        EventType $eventType,
        int $sortOrder,
        SupplierTemplateChecklistGroupSection $section,
        SupplierTemplateChecklistGroupAccountableTo $accountableTo
    ): void {
        $group = new SupplierTemplateChecklistGroupEntity;
        $group->id = Uuid::uuid4();
        $group->name = $name;
        $group->event_type = $eventType;
        $group->sort_order = $sortOrder;
        $group->accountable_to = $accountableTo;
        $group->section = $section;
        $group->supplier_id = $this->principal::get()->guardId;
        $group->created_by = $this->principal::get()->id;
        $group->created_at = Carbon::now();
        $group->save();
    }

    public function update(
        UuidInterface $id,
        string $name,
        int $sortOrder,
    ): void {
        SupplierTemplateChecklistGroupEntity::where('id', $id)
            ->update([
                'name' => $name,
                'sort_order' => $sortOrder,
                'updated_by' => $this->principal::get()->id,
                'updated_at' => Carbon::now(),
            ]);
    }

    public function destroy(UuidInterface $id): void
    {
        SupplierTemplateChecklistGroupEntity::where('id', $id)->delete();
    }
}
