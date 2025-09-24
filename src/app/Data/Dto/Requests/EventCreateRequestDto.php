<?php

namespace App\Data\Dto\Requests;

use App\Data\Dto\Requests\EventCelebrant\EventCelebrantRequestDto;
use App\Data\Dto\Requests\EventCelebrant\PairCelebrantRequestDto;
use App\Data\Dto\Requests\EventCelebrant\SingleCelebrantRequestDto;
use App\Enums\EventType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class EventCreateRequestDto
{
    private function __construct(
        public string $name,
        public EventType $type,
        public string $notes,
        public ClientRequestDto $client,
        public EventCelebrantRequestDto $celebrant
    ) {}

    public static function fromRequest(Request $request): EventCreateRequestDto
    {
        $request->validate([
            'name' => 'required',
            'type' => ['required', new Enum(EventType::class)],
            'client' => ['required'],
            'celebrant' => ['required'],
        ]);

        $eventType = EventType::from($request->type);

        return new EventCreateRequestDto(
            name: $request->name,
            type: $eventType,
            notes: $request->notes,
            client: ClientRequestDto::fromRequest(new Request($request->client)),
            celebrant: $eventType->celebrantCount() === 2
                ? PairCelebrantRequestDto::fromRequest(new Request($request->celebrant))
                : SingleCelebrantRequestDto::fromRequest(new Request($request->celebrant))
        );
    }
}
