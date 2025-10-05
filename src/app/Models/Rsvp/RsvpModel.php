<?php

declare(strict_types=1);

namespace App\Models\Rsvp;

use App\Data\Dto\Response\RsvpDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class RsvpModel
{
    public function __construct(
        public UuidInterface $id,
        public ?string $description,
        public int $guestsCount,
        public UuidInterface $scheduleId,
        public UuidInterface $supplierId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): RsvpDto
    {
        return new RsvpDto(
            id: $this->id,
            description: $this->description,
            guestsCount: $this->guestsCount,
            scheduleId: $this->scheduleId,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
