<?php

declare(strict_types=1);

namespace App\Models\OrganizerStaff;

use App\Dto\Response\OrganizerStaffDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class OrganizerStaffData
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

    public function toDto(): OrganizerStaffDto
    {
        return new OrganizerStaffDto(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->firstName,
            lastName: $this->lastName,
            dateOfBirth: $this->dateOfBirth,
            organizerId: $this->organizerId,
            organizerRoleId: $this->organizerRoleId,
            contactNumberId: $this->contactNumberId,
            addressId: $this->addressId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
