<?php

declare(strict_types=1);

namespace App\Models\RsvpGuestGroup;

use App\Data\Dto\Response\RsvpGuestGroupDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class RsvpGuestGroupModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public UuidInterface $rsvpId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): RsvpGuestGroupDto
    {
        return new RsvpGuestGroupDto(
            id: $this->id,
            name: $this->name,
            rsvpId: $this->rsvpId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
