<?php

declare(strict_types=1);

namespace App\Repositories\CelebrantRepository;

use App\Classes\Principals\Principal;
use App\Models\Celebrant\CelebrantEntity;
use App\Repositories\CelebrantRepository\Data\CelebrantUpsertRepoData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class CelebrantRepository
{
    public function __construct(private Principal $principal) {}

    public function create(CelebrantUpsertRepoData $data): UuidInterface
    {
        $id = Uuid::uuid4();
        $principal = $this->principal::get();

        $celebrant = new CelebrantEntity;
        $celebrant->id = $id;
        $celebrant->title = $data->title;
        $celebrant->first_name = $data->firstName;
        $celebrant->last_name = $data->lastName;
        $celebrant->supplier_id = $principal->guardId;
        $celebrant->address_id = $data->addressId;
        $celebrant->contact_number_id = $data->contactNumberId;
        $celebrant->save();

        return $id;
    }
}
