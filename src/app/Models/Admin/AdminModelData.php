<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Dto\Response\AdminDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class AdminModelData
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public Carbon $createdAt,
        public Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): AdminDto
    {
        return new AdminDto(
            id: $this->id,
            email: $this->email,
            firstName: $this->firstName,
            lastName: $this->lastName,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
