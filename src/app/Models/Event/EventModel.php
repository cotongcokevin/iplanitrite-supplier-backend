<?php

declare(strict_types=1);

namespace App\Models\Event;

use App\Data\Dto\Response\EventDto;
use App\Enums\EventStatus;
use App\Enums\EventType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public EventStatus $status,
        public EventType $type,
        public ?string $notes,
        public UuidInterface $clientId,
        public UuidInterface $celebrantOne,
        public ?UuidInterface $celebrantTwo,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventDto
    {
        return new EventDto(
            id: $this->id,
            name: $this->name,
            status: $this->status,
            type: $this->type,
            notes: $this->notes,
            clientId: $this->clientId,
            celebrantOne: $this->celebrantOne,
            celebrantTwo: $this->celebrantTwo,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
