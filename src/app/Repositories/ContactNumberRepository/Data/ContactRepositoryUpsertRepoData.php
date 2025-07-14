<?php

declare(strict_types=1);

namespace App\Repositories\ContactNumberRepository\Data;

use Ramsey\Uuid\UuidInterface;

class ContactRepositoryUpsertRepoData
{
    public function __construct(
        public ?UuidInterface $id,
        public string $number,
        public UuidInterface $countryId,
    ) {}
}
