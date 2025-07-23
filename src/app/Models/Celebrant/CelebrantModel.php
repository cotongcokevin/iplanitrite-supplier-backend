<?php

declare(strict_types=1);

namespace App\Models\Celebrant;

use App\Data\Dto\Response\CelebrantDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class CelebrantModel
{
    public function __construct(
        public UuidInterface $id,
        public string $firstName,
        public string $lastName,
        public ?Carbon $dateOfBirth,
        public ?UuidInterface $clientId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): CelebrantDto
    {
        return new CelebrantDto(
            id: $this->id,
            firstName: $this->firstName,
            lastName: $this->lastName,
            dateOfBirth: $this->dateOfBirth,
            clientId: $this->clientId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
