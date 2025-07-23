<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class LoginRequestDto
{
    private function __construct(
        public string $email,
        public string $password
    ) {}

    public static function fromRequest(Request $request): LoginRequestDto
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return new LoginRequestDto(
            $request->email,
            $request->password
        );
    }
}
