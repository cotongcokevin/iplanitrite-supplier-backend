<?php

namespace App\Data\Dto\Requests;

use App\Data\Dto\Requests\EventCelebrant\EventCelebrantRequest;
use App\Data\Dto\Requests\EventCelebrant\PairCelebrantRequestDto;
use App\Data\Dto\Requests\EventCelebrant\SingleCelebrantRequestDto;
use App\Data\Dto\Requests\EventSchedule\EventScheduleRequest;
use App\Data\Dto\Requests\EventSchedule\PairScheduleRequestDto;
use App\Data\Dto\Requests\EventSchedule\SingleScheduleRequestDto;
use App\Enums\EventType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class EventCreateRequestDto
{
    private function __construct(
        public string $name,
        public EventType $type,
        public ?string $notes,
        public ?float $initialDeposit,
        public EventScheduleRequest $schedule,
        public ClientRequestDto $client,
        public EventCelebrantRequest $celebrant
    ) {}

    public static function fromRequest(Request $request): EventCreateRequestDto
    {
        $request->validate([
            'name' => 'required',
            'type' => ['required', new Enum(EventType::class)],
            'client' => ['required'],
            'schedule' => ['required', 'array'],
            'initialDeposit' => ['nullable', 'numeric', 'gt:0'],
            'celebrant' => ['required'],
        ]);

        $eventType = EventType::from($request->type);

        return new EventCreateRequestDto(
            name: $request->name,
            type: $eventType,
            notes: $request->notes,
            initialDeposit: $request->initialDeposit,
            schedule: $eventType === EventType::WEDDING
                ? PairScheduleRequestDto::fromRequest(new Request($request->schedule))
                : SingleScheduleRequestDto::fromRequest(new Request($request->schedule)),
            client: ClientRequestDto::fromRequest(new Request($request->client)),
            celebrant: $eventType->celebrantCount() === 2
                ? PairCelebrantRequestDto::fromRequest(new Request($request->celebrant))
                : SingleCelebrantRequestDto::fromRequest(new Request($request->celebrant))
        );
    }
}
