<?php

declare(strict_types=1);

namespace App\Services;

use App\Classes\Pair;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupSortRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupUpdateRequestDto;
use App\Enums\EventType;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContext;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextType;
use App\Models\SupplierTemplateChecklistGroup\SupplierTemplateChecklistGroupModel;
use App\Repositories\SupplierTemplateChecklistGroupRepository\SupplierTemplateChecklistGroupRepository;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierTemplateChecklistGroupService
{
    public function __construct(
        private SupplierTemplateChecklistGroupRepository $groupRepository,
    ) {}

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
        return $this->groupRepository->getWithContext(
            $section,
            $eventType,
            $accountableTo,
            $contexts
        );
    }

    public function create(
        SupplierTemplateChecklistGroupCreateRequestDto $dto
    ): void {
        $lastGroup = $this->groupRepository->getLast(
            $dto->section,
            $dto->accountableTo
        );

        $this->groupRepository->create(
            name: $dto->name,
            eventType: $dto->eventType,
            sortOrder: $lastGroup ? ($lastGroup->sortOrder + 1) : 0,
            section: $dto->section,
            accountableTo: $dto->accountableTo
        );
    }

    public function sort(
        SupplierTemplateChecklistGroupSortRequestDto $dto
    ): void {
        $ids = collect(array_keys($dto->data))->map(fn ($id) => Uuid::fromString($id))->all();

        $entities = [];

        $groups = $this->groupRepository->getByIds($ids);
        foreach ($groups as &$group) {
            $group->sortOrder = $dto->data[(string) $group->id];
            $entities[] = $group->toEntity();
        }

        $this->groupRepository->sort($entities);
    }

    public function update(
        SupplierTemplateChecklistGroupUpdateRequestDto $dto,
        UuidInterface $id,
    ): void {
        $this->groupRepository->update(
            id: $id,
            name: $dto->name,
        );
    }

    public function destroy(UuidInterface $id): void
    {
        $this->groupRepository->destroy($id);
    }
}
