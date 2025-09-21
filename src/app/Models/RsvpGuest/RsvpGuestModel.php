<?php

declare(strict_types=1);

namespace App\Models\RsvpGuest;

use App\Data\Dto\Response\RsvpGuestDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class RsvpGuestModel
{
    public function __construct(
        public UuidInterface $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $status,
        public UuidInterface $rsvpId,
        public ?UuidInterface $rsvpGuestGroupId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): RsvpGuestDto
    {
        return new RsvpGuestDto(
            id: $this->id,
            firstName: $this->firstName,
            lastName: $this->lastName,
            email: $this->email,
            status: $this->status,
            rsvpId: $this->rsvpId,
            rsvpGuestGroupId: $this->rsvpGuestGroupId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
