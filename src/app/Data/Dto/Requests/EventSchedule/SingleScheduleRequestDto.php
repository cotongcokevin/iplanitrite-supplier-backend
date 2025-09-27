<?php

namespace App\Data\Dto\Requests\EventSchedule;

use Illuminate\Http\Request;

class SingleScheduleRequestDto implements EventScheduleRequest
{
    private function __construct(
        public EventScheduleRequestDto $data
    ) {}

    public static function fromRequest(Request $request): SingleScheduleRequestDto
    {
        $request->validate(['data' => ['required']]);

        return new SingleScheduleRequestDto(
            data: EventScheduleRequestDto::fromRequest(new Request($request->data))
        );
    }
}
