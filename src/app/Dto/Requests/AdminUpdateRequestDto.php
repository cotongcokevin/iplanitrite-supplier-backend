<?php

declare(strict_types=1);

namespace App\Dto\Requests;

use Illuminate\Http\Request;

class AdminUpdateRequestDto
{

    /**
     * @param string $email
     * @param ?string $password
     * @param string $firstName
     * @param string $lastName
     */
    private function __construct(
        public string $email,
        public ?string $password,
        public string $firstName,
        public string $lastName,
    ) {

    }

    /**
     * @param Request $request
     * @return AdminUpdateRequestDto
     */
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