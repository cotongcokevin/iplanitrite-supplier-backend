<?php

namespace App\Data\Dto\Requests;

use App\Enums\AppointeeType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Ramsey\Uuid\UuidInterface;

class ScheduleAppointeeRequestDto
{

    private function __construct(
        public UuidInterface $id,
        public AppointeeType $type
    ) {}

    public static function fromRequest(Request $request): ScheduleAppointeeRequestDto {
        $request->validate([
            'id' => ['required'],
            'type' => ['required', new Enum(AppointeeType::class)]
        ]);

        return new ScheduleAppointeeRequestDto(
            $request->id,
            $request->type
        );
    }

}