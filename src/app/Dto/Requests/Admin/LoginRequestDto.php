<?php

declare(strict_types=1);

namespace App\Dto\Requests\Admin;

use App\Dto\Dto;
use Illuminate\Http\Request;

class LoginRequestDto extends Dto
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
            email: $request->email,
            password: $request->password
        );
    }
}
