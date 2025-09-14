<?php

declare(strict_types=1);

namespace App\Repositories\ContactNumberRepository;

use App\Models\ContactNumber\ContactNumberEntity;
use App\Repositories\ContactNumberRepository\Data\ContactRepositoryUpsertRepoData;
use Ramsey\Uuid\UuidInterface;

class ContactNumberRepository
{
    public function upsert(
        ContactRepositoryUpsertRepoData $data,
    ): void {
        ContactNumberEntity::upsert([
            'number' => $data->number,
            'country_id' => $data->countryId,
            'id' => $data->id,
        ], ['id']);
    }

    public function destroy(UuidInterface $id): void
    {
        ContactNumberEntity::query()->whereKey($id)->delete();
    }
}
