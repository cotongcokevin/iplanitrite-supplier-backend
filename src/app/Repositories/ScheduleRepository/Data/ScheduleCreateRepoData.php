<?php

namespace App\Repositories\ScheduleRepository\Data;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ScheduleCreateRepoData
{
    public function __construct(
        public string $title,
        public Carbon $startDate,
        public Carbon $endDate,
        public ?string $notes,
        public bool $isMandatory,
        public ?UuidInterface $eventId,
        public ?UuidInterface $addressId,
    ) {}
}
