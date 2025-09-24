<?php

declare(strict_types=1);

namespace App\Repositories\ClientRepository;

use App\Classes\Principals\Principal;
use App\Models\Client\ClientEntity;
use App\Models\Client\ClientModel;
use App\Repositories\ClientRepository\Data\ClientCreateRepoData;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class ClientRepository
{
    public function __construct(
        private Principal $principal
    ) {}

    public function create(ClientCreateRepoData $data): ClientModel
    {
        $id = Uuid::uuid4();

        $client = new ClientEntity;
        $client->id = $id;
        $client->first_name = $data->firstName;
        $client->last_name = $data->lastName;
        $client->email = $data->email;
        $client->password = $data->password;
        $client->address_id = $data->addressId;
        $client->contact_number_id = $data->contactNumberId;
        $client->created_by = $this->principal::get()->id;
        $client->created_at = Carbon::now();
        $client->save();

        return $client->toModel();
    }
}
