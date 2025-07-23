<?php

declare(strict_types=1);

namespace App\Repositories\ClientRepository\Data;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ClientUpdateProfileRepoData
{
    public function __construct(
        public ?string $password,
        public string $firstName,
        public string $lastName,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $updatedBy,
        public ?Carbon $updatedAt,
    ) {}
}
