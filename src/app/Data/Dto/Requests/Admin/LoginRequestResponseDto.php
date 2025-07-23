<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Admin;

use App\Data\Dto\ResponseDto;
use Illuminate\Http\Request;

class LoginRequestResponseDto extends ResponseDto
{
    private function __construct(
        public string $email,
        public string $password
    ) {}

    public static function fromRequest(Request $request): LoginRequestResponseDto
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return new LoginRequestResponseDto(
            email: $request->email,
            password: $request->password
        );
    }
}
