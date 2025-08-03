<?php

declare(strict_types=1);

namespace App\Repositories\SupplierRepository;

use App\Classes\Principals\PrincipalData;
use App\Models\Supplier\SupplierEntity;
use App\Models\Supplier\SupplierModel;
use App\Repositories\SupplierRepository\Data\SupplierRepositoryStoreData;
use App\Repositories\SupplierRepository\Data\SupplierRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

class SupplierRepository
{
    /**
     * @return Collection<int, SupplierModel>
     */
    public function search(): Collection
    {
        $suppliers = SupplierEntity::get();

        return $suppliers->map(function (SupplierEntity $supplier) {
            return $supplier->toModel();
        });
    }

    public function getById(UuidInterface $uuid): SupplierModel
    {
        /** @var SupplierEntity $supplier */
        $supplier = SupplierEntity::find($uuid);

        return $supplier->toModel();
    }

    public function store(
        SupplierRepositoryStoreData $dto,
        PrincipalData $principal
    ): SupplierModel {
        $supplier = new SupplierEntity;
        $supplier->id = $dto->id;
        $supplier->name = $dto->name;
        $supplier->description = $dto->description;
        $supplier->subscription_tier = $dto->subscriptionTier->value;
        $supplier->created_by = $principal->id;
        $supplier->updated_by = $principal->id;
        $supplier->save();

        return $supplier->toModel();
    }

    public function update(
        SupplierRepositoryUpdateData $dto,
        UuidInterface $id,
        PrincipalData $principal
    ): SupplierModel {
        /** @var SupplierEntity $supplier */
        $supplier = SupplierEntity::find($id);
        $supplier->name = $dto->name;
        $supplier->description = $dto->description;
        $supplier->subscription_tier = $dto->subscriptionTier->value;
        $supplier->updated_by = $principal->id;
        $supplier->save();

        return $supplier->toModel();
    }

    public function destroy(UuidInterface $id): void
    {
        SupplierEntity::find($id)->delete();
    }
}
