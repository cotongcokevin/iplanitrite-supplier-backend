<?php

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class CelebrantRequestDto
{
    private function __construct(
        public string $title,
        public string $firstName,
        public string $lastName,
        public ?AddressRequestDto $address,
        public ?string $contactNumber
    ) {}

    public static function fromRequest(Request $request): CelebrantRequestDto
    {
        return new CelebrantRequestDto(
            title: $request->title,
            firstName: $request->firstName,
            lastName: $request->lastName,
            address: ! empty($request->address)
                ? AddressRequestDto::fromRequest(new Request($request->address))
                : null,
            contactNumber: $request->contactNumber ?? null
        );
    }
}
