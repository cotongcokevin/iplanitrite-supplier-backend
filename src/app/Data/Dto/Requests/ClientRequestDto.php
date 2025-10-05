<?php

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class ClientRequestDto
{
    private function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public AddressRequestDto $address,
        public string $contactNumber
    ) {}

    public static function fromRequest(Request $request): ClientRequestDto
    {
        $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        return new ClientRequestDto(
            $request->firstName,
            $request->lastName,
            $request->email,
            $request->password,
            AddressRequestDto::fromRequest(new Request($request->address)),
            $request->contactNumber
        );
    }
}
