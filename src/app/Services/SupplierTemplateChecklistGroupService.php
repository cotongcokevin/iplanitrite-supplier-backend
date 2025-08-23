<?php

declare(strict_types=1);

namespace App\Services;

use App\Classes\Pair;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupServiceCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistGroupServiceUpdateRequestDto;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContext;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextType;
use App\Models\SupplierTemplateChecklistGroup\SupplierTemplateChecklistGroupModel;
use App\Repositories\SupplierTemplateChecklistGroupRepository\SupplierTemplateChecklistGroupRepository;
use Illuminate\Support\Collection;
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
        SupplierTemplateChecklistGroupAccountableTo $accountableTo,
        array $contexts
    ): Collection {
        return $this->groupRepository->getWithContext(
            $section,
            $accountableTo,
            $contexts
        );
    }

    public function create(
        SupplierTemplateChecklistGroupServiceCreateRequestDto $dto
    ): void {
        $lastGroup = $this->groupRepository->getLast(
            $dto->section,
            $dto->accountableTo
        );

        $this->groupRepository->create(
            name: $dto->name,
            sortOrder: ($lastGroup?->sortOrder + 1) ?: 0,
            section: $dto->section,
            accountableTo: $dto->accountableTo
        );
    }

    public function update(
        SupplierTemplateChecklistGroupServiceUpdateRequestDto $dto,
        UuidInterface $id,
    ): void {
        $this->groupRepository->update(
            id: $id,
            name: $dto->name,
            sortOrder: $dto->sortOrder,
        );
    }

    public function destroy(UuidInterface $id): void
    {
        $this->groupRepository->destroy($id);
    }
}
