<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class OrganizerStaffDto
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?Carbon $dateOfBirth,
        public UuidInterface $organizerId,
        public UuidInterface $organizerRoleId,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
