<?php

declare(strict_types=1);

namespace App\Models\Event;

use App\Data\Dto\Response\EventDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventModel
{
    public function __construct(
        public UuidInterface $id,
        public string $status,
        public string $name,
        public string $type,
        public UuidInterface $clientId,
        public UuidInterface $celebrantOne,
        public UuidInterface $celebrantTwo,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventDto
    {
        return new EventDto(
            id: $this->id,
            status: $this->status,
            name: $this->name,
            type: $this->type,
            clientId: $this->clientId,
            celebrantOne: $this->celebrantOne,
            celebrantTwo: $this->celebrantTwo,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
