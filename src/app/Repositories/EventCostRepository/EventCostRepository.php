<?php

declare(strict_types=1);

namespace App\Repositories\EventCostRepository;

use App\Classes\Principals\Principal;
use App\Models\EventCost\EventCostEntity;
use App\Models\EventCost\EventCostModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

readonly class EventCostRepository
{

    public function __construct(
        private Principal $principal,
    ) {}

    public function create(
        string $name,
        float $amount,
        string $eventId,
    ): EventCostModel {
        $principal = $this->principal::get();

        $cost = new EventCostEntity();
        $cost->id = Uuid::uuid4();
        $cost->name = $name;
        $cost->amount = $amount;
        $cost->event_id = $eventId;
        $cost->supplier_id = $principal->guardId;
        $cost->created_by = $principal->id;
        $cost->created_at = Carbon::now();
        $cost->save();

        return $cost->toModel();
    }
}
