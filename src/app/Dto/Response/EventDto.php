<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventDto extends ResponseDto
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
}
