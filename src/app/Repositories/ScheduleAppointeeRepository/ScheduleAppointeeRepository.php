<?php

declare(strict_types=1);

namespace App\Repositories\ScheduleAppointeeRepository;

use App\Enums\AppointeeType;
use App\Models\ScheduleAppointee\ScheduleAppointeeEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class ScheduleAppointeeRepository
{
    public function create(
        UuidInterface $appointeeId,
        AppointeeType $appointeeType,
        UuidInterface $scheduleId,
    ): void {
        $appointee = new ScheduleAppointeeEntity;
        $appointee->id = Uuid::uuid4();
        $appointee->appointee_id = $appointeeId;
        $appointee->appointee_type = $appointeeType;
        $appointee->schedule_id = $scheduleId;
        $appointee->save();
    }
}
