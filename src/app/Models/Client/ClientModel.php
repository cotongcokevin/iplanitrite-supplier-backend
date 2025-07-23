<?php

declare(strict_types=1);

namespace App\Models\Client;

use App\Dto\Response\ClientDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ClientModel
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public UuidInterface $contactNumberId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): ClientDto
    {
        return new ClientDto(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->firstName,
            lastName: $this->lastName,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
