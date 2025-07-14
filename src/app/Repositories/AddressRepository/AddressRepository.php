<?php

declare(strict_types=1);

namespace App\Repositories\AddressRepository;

use App\Models\Address\AddressEntity;
use App\Repositories\AddressRepository\Data\AddressRepositoryUpsertRepoData;

class AddressRepository
{
    public function upsert(
        AddressRepositoryUpsertRepoData $data,
    ): void {
        AddressEntity::upsert((array) $data, ['id']);
    }
}
