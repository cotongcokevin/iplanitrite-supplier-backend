<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;

class ScheduleAppointeeDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $appointeeType,
        public string $appointeeId,
        public UuidInterface $scheduleId,
        public UuidInterface $supplierId,
    ) {}
}
