<?php

namespace App\Data\Dto\Requests\EventSchedule;

use App\Data\Dto\Requests\AddressRequestDto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventScheduleRequestDto
{

    private function __construct(
        public Carbon $date,
        public ?int $guestsCount,
        public ?AddressRequestDto $address
    ) {}

    public static function fromRequest(Request $request): EventScheduleRequestDto {
        $request->validate([
            'date' => ['required', 'date'],
            'guestsCount' => ['nullable', 'numeric', 'gt:0'],
        ]);

        return new EventScheduleRequestDto(
            Carbon::parse($request->date),
            $request->guestsCount ?? null,
            $request->address
                ? AddressRequestDto::fromRequest(
                    new Request($request->address)
                )
                : null
        );
    }

}