<?php

declare(strict_types=1);

namespace App\Repositories\ContactNumberRepository\Data;

use Ramsey\Uuid\UuidInterface;

class ContactRepositoryUpsertRepoData
{
    public function __construct(
        public string $number,
        public UuidInterface $countryId,
        public UuidInterface $id,
    ) {}
}
