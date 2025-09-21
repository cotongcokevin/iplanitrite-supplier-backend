<?php

declare(strict_types=1);

namespace App\Models\ScheduleAppointee;

use App\Data\Dto\Response\ScheduleAppointeeDto;
use Ramsey\Uuid\UuidInterface;

class ScheduleAppointeeModel
{
    public function __construct(
        public UuidInterface $id,
        public string $appointeeType,
        public string $appointeeId,
        public ?UuidInterface $eventId,
    ) {}

    public function toDto(): ScheduleAppointeeDto
    {
        return new ScheduleAppointeeDto(
            id: $this->id,
            appointeeType: $this->appointeeType,
            appointeeId: $this->appointeeId,
            eventId: $this->eventId,
        );
    }
}
