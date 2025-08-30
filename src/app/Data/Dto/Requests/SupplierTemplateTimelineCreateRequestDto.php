<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use App\Enums\EventType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SupplierTemplateTimelineCreateRequestDto
{

    public function __construct(
        public string $name,
        public bool $isRsvp,
        public EventType $eventType,
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateTimelineCreateRequestDto
    {
        $request->validate([
            'name' => ['required'],
            'isRsvp' => ['required'],
            'eventType' => ['required', new Enum(EventType::class)],
        ]);

        return new SupplierTemplateTimelineCreateRequestDto(
            $request->name,
            $request->isRsvp,
            EventType::from($request->eventType),
        );
    }
}