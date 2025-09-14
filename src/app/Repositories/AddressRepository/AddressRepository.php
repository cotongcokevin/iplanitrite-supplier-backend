<?php

declare(strict_types=1);

namespace App\Repositories\AddressRepository;

use App\Models\Address\AddressEntity;
use App\Repositories\AddressRepository\Data\AddressRepositoryUpsertRepoData;
use Ramsey\Uuid\UuidInterface;

class AddressRepository
{
    public function upsert(
        AddressRepositoryUpsertRepoData $data,
    ): void {
        AddressEntity::query()->upsert((array) $data, ['id']);
    }

    public function destroy(UuidInterface $id): void
    {
        AddressEntity::query()->whereKey($id)->delete();
    }
}
