<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Dto\Requests\SupplierTemplateChecklistCreateRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistSortRequestDto;
use App\Data\Dto\Requests\SupplierTemplateChecklistUpdateRequestDto;
use App\Repositories\SupplierTemplateChecklistRepository\SupplierTemplateChecklistRepository;
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
            sortOrder: $dto->sortOrder
        );
    }

    public function sort(
        SupplierTemplateChecklistSortRequestDto $dto
    ): void {
        $this->repository->sort(
            $dto->data
        );
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
