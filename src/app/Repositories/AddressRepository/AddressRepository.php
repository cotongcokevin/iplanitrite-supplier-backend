<?php

declare(strict_types=1);

namespace App\Repositories\AddressRepository;

use App\Models\Address\AddressEntity;
use App\Repositories\AddressRepository\Data\AddressRepositoryUpsertRepoData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class AddressRepository
{
    public function upsert(
        AddressRepositoryUpsertRepoData $data,
    ): void {
        AddressEntity::upsert((array) $data, ['id']);
    }

    public function duplicate(UuidInterface $id): UuidInterface
    {
        $original = AddressEntity::where('id', $id)->first();

        $address = new AddressEntity;
        $address->id = Uuid::uuid4();
        $address->line1 = $original->line1;
        $address->line2 = $original->line2;
        $address->city = $original->city;
        $address->state = $original->state;
        $address->zip = $original->zip;
        $address->lat = $original->lat;
        $address->long = $original->long;
        $address->save();

        return $address->id;
    }
}
