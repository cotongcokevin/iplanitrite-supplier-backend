<?php

namespace App\Services;

use App\Enums\EventType;
use App\Models\Event\EventModel;
use App\Repositories\EventRepository\EventRepository;
use App\Repositories\ScheduleRepository\ScheduleRepository;
use Exception;

readonly class ScheduleService
{

    public function __construct(
        private ScheduleRepository $scheduleRepository
    ) {}

    /**
     * @throws Exception
     */
    public function createMandatoryEventSchedule(EventModel $event) {
        switch($event->type) {
            case EventType::WEDDING:

                break;
            case EventType::BAPTISM:
            case EventType::ENGAGEMENT:
            case EventType::BRIDAL_SHOWER:
            case EventType::BABY_SHOWER:
            case EventType::DEBUT:
            case EventType::BIRTHDAY:
            case EventType::ANNIVERSARY:
            case EventType::ANNIVERSARY_COUPLE:
            case EventType::CORPORATE_EVENT:
                break;
            default:
                throw new Exception("Invalid Event Type");
        }
    }

}