<?php

declare(strict_types=1);

namespace App\Repositories\ContactNumberRepository;

use App\Models\ContactNumber\ContactNumberEntity;
use App\Repositories\ContactNumberRepository\Data\ContactRepositoryUpsertRepoData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ContactNumberRepository
{
    public function upsert(
        ContactRepositoryUpsertRepoData $data,
    ): void {
        ContactNumberEntity::upsert([
            'id' => $data->id,
            'number' => $data->number,
            'country_id' => $data->countryId,
        ], ['id']);
    }

    public function duplicate(UuidInterface $id): UuidInterface
    {
        $original = ContactNumberEntity::where('id', $id)->first();

        $contact = new ContactNumberEntity;
        $contact->id = Uuid::uuid4();
        $contact->number = $original->number;
        $contact->country_id = $original->country_id;
        $contact->save();

        return $contact->id;
    }
}
