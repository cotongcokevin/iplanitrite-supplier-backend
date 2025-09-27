<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class ScheduleDto extends ResponseDto
{
    
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public Carbon $startDate,
        public Carbon $endDate,
        public ?string $notes,
        public bool $isMandatory,
        public ?UuidInterface $eventId,
        public ?UuidInterface $addressId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
