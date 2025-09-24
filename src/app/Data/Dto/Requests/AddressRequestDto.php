<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class AddressRequestDto
{
    private function __construct(
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zip,
        public ?string $lat,
        public ?string $long,
    ) {}

    public static function fromRequest(Request $request): AddressRequestDto
    {
        $request->validate([
            'line1' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'zip' => ['required'],
            'lat' => ['numeric', 'nullable'],
            'long' => ['numeric', 'nullable'],
        ]);

        return new AddressRequestDto(
            line1: $request->line1,
            line2: $request->line2 ?? null,
            city: $request->city,
            state: $request->state,
            zip: $request->zip,
            lat: $request->lat ?? null,
            long: $request->long ?? null,
        );
    }
}
