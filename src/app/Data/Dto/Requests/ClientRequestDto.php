<?php

namespace App\Data\Dto\Requests;

use App\Repositories\ClientRepository\Data\ClientCreateRepoData;

class ClientRequestDto
{

    private function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public AddressRequestDto $address,
        public string $contactNumber
    ) {}

}