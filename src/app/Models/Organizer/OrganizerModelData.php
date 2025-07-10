<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Dto\Response\OrganizerDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class OrganizerModelData
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public int $maxStaff,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public Carbon $createdAt,
        public Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): OrganizerDto
    {
        return new OrganizerDto(
            id: $this->id,
            name: $this->name,
            maxStaff: $this->maxStaff,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
