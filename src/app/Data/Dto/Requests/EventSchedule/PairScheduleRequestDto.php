<?php

namespace App\Data\Dto\Requests\EventSchedule;

use App\Data\Dto\Requests\CelebrantRequestDto;
use App\Data\Dto\Requests\EventCelebrant\EventCelebrantRequest;
use Illuminate\Http\Request;

class PairScheduleRequestDto implements EventScheduleRequest
{
    private function __construct(
        public EventScheduleRequestDto $first,
        public EventScheduleRequestDto $second,
    ) {}

    public static function fromRequest(Request $request): PairScheduleRequestDto
    {
        $request->validate([
            'first' => ['required'],
            'second' => ['required']
        ]);

        return new PairScheduleRequestDto(
            first: EventScheduleRequestDto::fromRequest(new Request($request->first)),
            second: EventScheduleRequestDto::fromRequest(new Request($request->second))
        );
    }
}
