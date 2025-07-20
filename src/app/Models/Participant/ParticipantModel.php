<?php

declare(strict_types=1);

namespace App\Models\Participant;

use App\Dto\Response\ParticipantDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ParticipantModel
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?Carbon $dateOfBirth,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): ParticipantDto
    {
        return new ParticipantDto(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->firstName,
            lastName: $this->lastName,
            dateOfBirth: $this->dateOfBirth,
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
