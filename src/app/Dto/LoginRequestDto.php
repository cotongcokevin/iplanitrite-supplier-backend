<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Http\Request;

class LoginRequestDto extends Dto
{

    /**
     * @param string $email
     * @param string $password
     */
    private function __construct(
        public string $email,
        public string $password
    ) {

    }

    /**
     * @param Request $request
     * @return LoginRequestDto
     */
    public static function fromRequest(Request $request): LoginRequestDto
    {
        return new LoginRequestDto(
            $request->email,
            $request->password
        );
    }

}