<?php

namespace App\Data\Dto\Requests;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\UuidInterface;

class ScheduleCreateRequestDto
{
    /**
     * @param  ScheduleAppointeeRequestDto[]  $appointees
     */
    private function __construct(
        public string $title,
        public Carbon $startDate,
        public Carbon $endDate,
        public ?string $notes,
        public ?UuidInterface $eventId,
        public ?AddressRequestDto $address,
        public array $appointees
    ) {}

    public static function fromRequest(Request $request): ScheduleCreateRequestDto
    {
        return new ScheduleCreateRequestDto(
            $request->title,
            $request->startDate,
            $request->endDate,
            $request->notes ?? null,
            $request->eventId ?? null,
            $request->address
                ? $request->address instanceof AddressRequestDto
                    ? $request->address
                    : AddressRequestDto::fromRequest(new Request($request->address))
                : null,
            array_map(
                function ($appointee) {
                    return ScheduleAppointeeRequestDto::fromRequest(
                        new Request($appointee)
                    );
                }, $request->appointees
            )
        );
    }
}
