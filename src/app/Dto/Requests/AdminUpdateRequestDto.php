<?php

declare(strict_types=1);

namespace App\Dto\Requests;

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
        return new AdminUpdateRequestDto(
            $request->email,
            $request->password,
            $request->firstName,
            $request->lastName,
        );
    }
}
