<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Enums\OrganizerPermissionType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class OrganizerPermissionDto
{
    public function __construct(
        public UuidInterface $id,
        public OrganizerPermissionType $name,
        public ?UuidInterface $organizerRoleId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}
}
