<?php

declare(strict_types=1);

namespace App\Repositories\ClientRepository;

use App\Classes\Principals\Principal;
use App\Models\Client\ClientEntity;
use App\Repositories\ClientRepository\Data\ClientCreateRepoData;
use Carbon\Carbon;
use Symfony\Component\Uid\Uuid;

readonly class ClientRepository {

    public function __construct(
        private Principal $principal
    ) {}

    public function create(ClientCreateRepoData $data) {
        $client = new ClientEntity();
        $client->id = Uuid::v4();
        $client->first_name = $data->firstName;
        $client->last_name = $data->lastName;
        $client->email = $data->email;
        $client->password = $data->password;
        $client->address_id = $data->addressId;
        $client->contact_number_id = $data->contactNumberId;
        $client->created_by = $this->principal::get()->id;
        $client->created_at = Carbon::now();
        $client->save();

        return $client->id;
    }

}
