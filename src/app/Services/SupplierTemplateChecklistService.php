<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Dto\Requests\SupplierTemplateChecklistCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistSortRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistUpdateRequestDto;
use App\Repositories\SupplierTemplateChecklistRepository\SupplierTemplateChecklistRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SupplierTemplateChecklistService
{
    public function __construct(
        private SupplierTemplateChecklistRepository $repository,
    ) {}

    public function create(
        SupplierTemplateChecklistCreateRequestDto $dto,
        UuidInterface $groupId
    ): void {
        $model = $this->repository->getLastChecklist(
            $groupId
        );

        $this->repository->create(
            groupId: $groupId,
            description: $dto->description,
            sortOrder: $model ? ($model->sortOrder + 1) : 0
        );
    }

    public function update(
        SupplierTemplateChecklistUpdateRequestDto $dto,
        UuidInterface $groupId,
        UuidInterface $id
    ): void {
        $this->repository->update(
            groupId: $groupId,
            id: $id,
            description: $dto->description,
        );
    }

    public function sort(
        SupplierTemplateChecklistSortRequestDto $dto,
        UuidInterface $groupId,
    ): void {
        $ids = collect(array_keys($dto->data))->map(fn ($id) => Uuid::fromString($id))->all();

        $entities = [];

        $checklists = $this->repository->getByIds($groupId, $ids);
        foreach ($checklists as &$checklist) {
            $checklist->sortOrder = $dto->data[(string) $checklist->id];
            $entities[] = $checklist->toEntity();
        }

        $this->repository->sort($entities);
    }

    public function delete(
        UuidInterface $groupId,
        UuidInterface $id
    ): void {
        $this->repository->delete(
            groupId: $groupId,
            id: $id
        );
    }
}
