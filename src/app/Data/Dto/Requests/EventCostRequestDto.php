<?php

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;
use Ramsey\Uuid\UuidInterface;

class EventCostRequestDto
{
    private function __construct(
        public string $name,
        public float $amount,
        public UuidInterface $eventId,
    ) {}

    public static function fromRequest(Request $request): EventCostRequestDto
    {
        $request->validate([
            'name' => ['required'],
            'amount' => ['required'],
            'eventId' => ['required'],
        ]);

        return new EventCostRequestDto(
            $request->name,
            $request->amount,
            $request->eventId,
        );
    }
}
