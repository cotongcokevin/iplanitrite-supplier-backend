<?php

declare(strict_types=1);

namespace App\Repositories\AddressRepository;

use App\Models\Address\Address;
use App\Repositories\AddressRepository\Data\AddressRepositoryUpsertRepoData;

class AddressRepository
{
    public function upsert(
        AddressRepositoryUpsertRepoData $data,
    ): void {
        Address::upsert((array) $data, ['id']);
    }
}
