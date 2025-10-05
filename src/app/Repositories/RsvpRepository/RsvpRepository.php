<?php

declare(strict_types=1);

namespace App\Repositories\RsvpRepository;

use App\Classes\Principals\Principal;
use App\Models\Rsvp\RsvpEntity;
use App\Models\Rsvp\RsvpModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class RsvpRepository
{
    public function __construct(
        private Principal $principal
    ) {}

    public function create(
        UuidInterface $scheduleId,
        int $guestsCount
    ): RsvpModel {
        $principal = $this->principal::get();

        $rsvpEntity = new RsvpEntity;
        $rsvpEntity->id = Uuid::uuid4();
        $rsvpEntity->schedule_id = $scheduleId;
        $rsvpEntity->supplier_id = $principal->guardId;
        $rsvpEntity->guests_count = $guestsCount;
        $rsvpEntity->created_at = Carbon::now();
        $rsvpEntity->created_by = $principal->id;
        $rsvpEntity->save();

        return $rsvpEntity->toModel();
    }
}
