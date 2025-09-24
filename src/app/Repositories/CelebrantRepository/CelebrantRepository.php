<?php

declare(strict_types=1);

namespace App\Repositories\CelebrantRepository;

use App\Models\Celebrant\CelebrantEntity;
use App\Repositories\CelebrantRepository\Data\CelebrantUpsertRepoData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class CelebrantRepository
{
    public function create(CelebrantUpsertRepoData $data): UuidInterface
    {
        $id = Uuid::uuid4();

        $celebrant = new CelebrantEntity;
        $celebrant->id = $id;
        $celebrant->first_name = $data->firstName;
        $celebrant->last_name = $data->lastName;
        $celebrant->contact_number_id = $data->contactNumberId;
        $celebrant->save();

        return $id;
    }
}
