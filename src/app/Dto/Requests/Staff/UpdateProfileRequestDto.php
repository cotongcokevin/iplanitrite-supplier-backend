<?php

declare(strict_types=1);

namespace App\Dto\Requests\Staff;

use App\Dto\Requests\AddressRequestDto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateProfileRequestDto
{
    private function __construct(
        public ?string $password,
        public string $firstName,
        public string $lastName,
        public Carbon $dateOfBirth,
        public string $contactNumber,
        public AddressRequestDto $address
    ) {}

    public static function fromRequest(Request $request): UpdateProfileRequestDto
    {
        $request->validate([
            'password' => 'string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'dateOfBirth' => 'date',
            'contactNumber' => 'string|required',
            'address' => 'required',
            'address.line1' => 'string|required',
            'address.line2' => 'string',
            'address.city' => 'string|required',
            'address.state' => 'string|required',
            'address.zip' => 'string|required',
            'address.lat' => 'string',
            'address.long' => 'string',
        ]);

        return new UpdateProfileRequestDto(
            password: $request->password,
            firstName: $request->firstName,
            lastName: $request->lastName,
            dateOfBirth: Carbon::parse($request->dateOfBirth),
            contactNumber: $request->contactNumber,
            address: $request->address ? new AddressRequestDto(
                line1: $request->address->line1,
                line2: $request->address->line2,
                city: $request->address->city,
                state: $request->address->state,
                zip: $request->address->zip,
                lat: $request->address->lat,
                long: $request->address->long,
            ) : null
        );
    }
}
