<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Supplier;

use App\Data\Dto\Requests\AddressRequestDto;
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
            'address.line2' => 'string|nullable',
            'address.city' => 'string|required',
            'address.state' => 'string|required',
            'address.zip' => 'string|required',
            'address.lat' => 'string|nullable',
            'address.long' => 'string|nullable',
        ]);

        return new UpdateProfileRequestDto(
            password: $request->password,
            firstName: $request->firstName,
            lastName: $request->lastName,
            dateOfBirth: Carbon::parse($request->dateOfBirth),
            contactNumber: $request->contactNumber,
            address: $request->address ? new AddressRequestDto(
                line1: $request->address['line1'],
                line2: $request->address['line2'],
                city: $request->address['city'],
                state: $request->address['state'],
                zip: $request->address['zip'],
                lat: $request->address['lat'],
                long: $request->address['long'],
            ) : null
        );
    }
}
