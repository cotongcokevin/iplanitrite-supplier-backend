<?php

declare(strict_types=1);

namespace App\Dto\Requests\Client;

use Illuminate\Http\Request;

class UpdateProfileRequestDto
{
    private function __construct(
        public ?string $password,
        public string $firstName,
        public string $lastName,
        public string $contactNumber
    ) {}

    public static function fromRequest(Request $request): UpdateProfileRequestDto
    {
        $request->validate([
            'password' => 'string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'contactNumber' => 'string|required',
        ]);

        return new UpdateProfileRequestDto(
            password: $request->password,
            firstName: $request->firstName,
            lastName: $request->lastName,
            contactNumber: $request->contactNumber
        );
    }
}
