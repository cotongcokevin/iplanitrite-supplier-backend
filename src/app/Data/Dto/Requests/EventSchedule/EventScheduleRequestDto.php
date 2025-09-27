<?php

namespace App\Data\Dto\Requests\EventSchedule;

use App\Data\Dto\Requests\AddressRequestDto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventScheduleRequestDto
{

    private function __construct(
        public Carbon $date,
        public ?AddressRequestDto $address
    ) {}

    public static function fromRequest(Request $request): EventScheduleRequestDto {
        $request->validate([
            'date' => ['required', 'date']
        ]);

        return new EventScheduleRequestDto(
            Carbon::parse($request->date),
            $request->address
                ? AddressRequestDto::fromRequest(
                    new Request($request->address)
                )
                : null
        );
    }

}