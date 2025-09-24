<?php

namespace App\Repositories\ClientRepository\Data;

use Ramsey\Uuid\UuidInterface;

class ClientCreateRepoData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public ?UuidInterface $addressId,
        public ?UuidInterface $contactNumberId
    ) {}

}
