<?php

declare(strict_types=1);

namespace App\Repositories\AddressRepository\Data;

use Ramsey\Uuid\UuidInterface;

class AddressRepositoryUpsertRepoData
{
    public function __construct(
        public ?UuidInterface $id,
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zip,
        public ?string $lat,
        public ?string $long,
    ) {}
}
