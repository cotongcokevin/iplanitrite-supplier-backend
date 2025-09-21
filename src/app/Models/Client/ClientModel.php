<?php

declare(strict_types=1);

namespace App\Models\Client;

use App\Data\Dto\Response\ClientDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ClientModel
{
    public function __construct(
        public UuidInterface $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): ClientDto
    {
        return new ClientDto(
            id: $this->id,
            firstName: $this->firstName,
            lastName: $this->lastName,
            email: $this->email,
            password: $this->password,
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
