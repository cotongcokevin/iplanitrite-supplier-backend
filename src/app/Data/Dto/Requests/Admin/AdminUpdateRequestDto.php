<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Admin;

use Illuminate\Http\Request;

class AdminUpdateRequestDto
{
    private function __construct(
        public string $email,
        public ?string $password,
        public string $firstName,
        public string $lastName,
    ) {}

    public static function fromRequest(Request $request): AdminUpdateRequestDto
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
        ]);

        return new AdminUpdateRequestDto(
            email: $request->email,
            password: $request->password,
            firstName: $request->firstName,
            lastName: $request->lastName,
        );
    }
}
