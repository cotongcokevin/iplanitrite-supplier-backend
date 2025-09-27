<?php

namespace App\Services;

use App\Enums\AppointeeType;
use App\Repositories\ScheduleAppointeeRepository\ScheduleAppointeeRepository;
use Ramsey\Uuid\UuidInterface;

readonly class ScheduleAppointeeService
{
    public function __construct(
        private ScheduleAppointeeRepository $repository
    ) {}

    public function create(
        UuidInterface $appointeeId,
        AppointeeType $appointeeType,
        UuidInterface $scheduleId,
    ): void {
        $this->repository->create($appointeeId, $appointeeType, $scheduleId);
    }
}
