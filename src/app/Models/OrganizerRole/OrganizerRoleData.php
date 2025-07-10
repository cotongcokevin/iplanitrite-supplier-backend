<?php

declare(strict_types=1);

namespace App\Models\OrganizerRole;

use App\Dto\Response\OrganizerRoleDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class OrganizerRoleData
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public bool $immutable,
        public ?UuidInterface $organizerId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): OrganizerRoleDto
    {
        return new OrganizerRoleDto(
            id: $this->id,
            name: $this->name,
            immutable: $this->immutable,
            organizerId: $this->organizerId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
