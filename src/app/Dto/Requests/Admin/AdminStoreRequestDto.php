<?php

declare(strict_types=1);

namespace App\Dto\Requests\Admin;

use Illuminate\Http\Request;

class AdminStoreRequestDto
{
    private function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
    ) {}

    public static function fromRequest(Request $request): AdminStoreRequestDto
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
        ]);

        return new AdminStoreRequestDto(
            email: $request->email,
            password: $request->password,
            firstName: $request->firstName,
            lastName: $request->lastName,
        );
    }
}
