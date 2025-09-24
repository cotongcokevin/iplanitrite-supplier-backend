<?php

namespace App\Repositories\EventRepository\Data;

use App\Enums\EventStatus;
use App\Enums\EventType;
use Ramsey\Uuid\UuidInterface;

class EventCreateRepoData
{
    public function __construct(
        public string $name,
        public EventType $type,
        public EventStatus $status,
        public ?string $notes,
        public UuidInterface $clientId,
        public UuidInterface $celebrantOne,
        public ?UuidInterface $celebrantTwo
    ) {}

}
