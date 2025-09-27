<?php

declare(strict_types=1);

namespace App\Repositories\ScheduleRepository;

use App\Classes\Principals\Principal;
use App\Models\Schedule\ScheduleEntity;
use App\Models\Schedule\ScheduleModel;
use App\Repositories\ScheduleRepository\Data\ScheduleCreateRepoData;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

readonly class ScheduleRepository
{
    public function __construct(
        private Principal $principal
    ) {}

    public function create(ScheduleCreateRepoData $data): ScheduleModel
    {
        $schedule = new ScheduleEntity;
        $schedule->id = Uuid::uuid4();
        $schedule->title = $data->title;
        $schedule->start_date = $data->startDate;
        $schedule->end_date = $data->endDate;
        $schedule->notes = $data->notes;
        $schedule->is_mandatory = $data->isMandatory;
        $schedule->event_id = $data->eventId;
        $schedule->address_id = $data->addressId;
        $schedule->created_by = $this->principal::get()->id;
        $schedule->created_at = Carbon::now();
        $schedule->save();

        return $schedule->toModel();
    }
}
