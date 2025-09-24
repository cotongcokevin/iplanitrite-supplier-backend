<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Enums\EventStatus;
use App\Enums\EventType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public EventStatus $status,
        public EventType $type,
        public string $notes,
        public UuidInterface $clientId,
        public UuidInterface $celebrantOne,
        public ?UuidInterface $celebrantTwo,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
