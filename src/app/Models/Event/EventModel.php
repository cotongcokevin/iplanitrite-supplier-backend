<?php

declare(strict_types=1);

namespace App\Models\Event;

use App\Dto\Response\EventResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $status,
        public ?string $reasonForCancellation,
        public string $type,
        public UuidInterface $participantOne,
        public UuidInterface $participantTwo,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventResponseDto
    {
        return new EventResponseDto(
            id: $this->id,
            name: $this->name,
            status: $this->status,
            reasonForCancellation: $this->reasonForCancellation,
            type: $this->type,
            participantOne: $this->participantOne,
            participantTwo: $this->participantTwo,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
