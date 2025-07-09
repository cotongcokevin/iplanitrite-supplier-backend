<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class AdminDto
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $firstName,
        public string $lastName,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public Carbon $createdAt,
        public Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
