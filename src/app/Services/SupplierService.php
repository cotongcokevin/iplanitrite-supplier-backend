<?php

declare(strict_types=1);

namespace App\Services;

use App\Classes\Principals\Principal;
use App\Data\Dto\Requests\Admin\SupplierStoreRequestDto;
use App\Data\Dto\Requests\Admin\SupplierUpdateRequestDto;
use App\Models\Supplier\SupplierModel;
use App\Repositories\SupplierRepository\Data\SupplierRepositoryStoreData;
use App\Repositories\SupplierRepository\Data\SupplierRepositoryUpdateData;
use App\Repositories\SupplierRepository\SupplierRepository;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierService
{
    public function __construct(private SupplierRepository $supplierRepository, private Principal $principal, private UuidFactory $uuid) {}

    /**
     * @return Collection<int, SupplierModel>
     */
    public function search(): Collection
    {
        return $this->supplierRepository->search();
    }

    public function getById(UuidInterface $id): SupplierModel
    {
        return $this->supplierRepository->getById($id);
    }

    public function store(SupplierStoreRequestDto $dto): SupplierModel
    {
        $repoDto = new SupplierRepositoryStoreData(
            $this->uuid->uuid4(),
            name: $dto->name,
            description: $dto->description,
            subscriptionTier: $dto->subscriptionTier,
        );

        return $this->supplierRepository->store(
            $repoDto,
            $this->principal::get()
        );
    }

    public function update(
        SupplierUpdateRequestDto $dto,
        UuidInterface $id
    ): SupplierModel {
        $repoDto = new SupplierRepositoryUpdateData(
            name: $dto->name,
            description: $dto->description,
            subscriptionTier: $dto->subscriptionTier,
        );

        return $this->supplierRepository->update(
            $repoDto,
            $id,
            $this->principal::get()
        );
    }

    public function destroy(UuidInterface $id): void
    {
        $this->supplierRepository->destroy($id);
    }
}
