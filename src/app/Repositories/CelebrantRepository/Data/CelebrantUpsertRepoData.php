<?php

namespace App\Repositories\CelebrantRepository\Data;

use Ramsey\Uuid\UuidInterface;

class CelebrantUpsertRepoData
{
    public function __construct(
        public string $title,
        public string $firstName,
        public string $lastName,
        public UuidInterface $addressId,
        public UuidInterface $contactNumberId
    ) {}

}
