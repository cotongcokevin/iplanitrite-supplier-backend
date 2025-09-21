<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class RsvpDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $description,
        public int $guestsCount,
        public UuidInterface $scheduleId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
