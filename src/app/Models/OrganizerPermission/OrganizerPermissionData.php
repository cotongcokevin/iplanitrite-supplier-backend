<?php

declare(strict_types=1);

namespace App\Models\OrganizerPermission;

use App\Dto\Response\OrganizerPermissionDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class OrganizerPermissionData
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public ?UuidInterface $organizerRoleId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): OrganizerPermissionDto
    {
        return new OrganizerPermissionDto(
            id: $this->id,
            name: $this->name,
            organizerRoleId: $this->organizerRoleId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
