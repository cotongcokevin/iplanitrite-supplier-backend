<?php

namespace App\Services;

use App\Data\Dto\Requests\EventCostRequestDto;
use App\Models\EventCost\EventCostModel;
use App\Repositories\EventCostRepository\EventCostRepository;

class EventCostService
{

    public function __construct(
        private EventCostRepository $repository,
    ) {}

    public function create(EventCostRequestDto $request): EventCostModel
    {
        return $this->repository->create(
            name: $request->name,
            amount: $request->amount,
            eventId: $request->eventId,
        );
    }

}