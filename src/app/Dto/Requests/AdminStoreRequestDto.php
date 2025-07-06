<?php

declare(strict_types=1);

namespace App\Dto\Requests;

use Illuminate\Http\Request;

class AdminStoreRequestDto
{

    /**
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     */
    private function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
    ) {

    }

    /**
     * @param Request $request
     * @return AdminStoreRequestDto
     */
    public static function fromRequest(Request $request): AdminStoreRequestDto
    {
        return new AdminStoreRequestDto(
            $request->email,
            $request->password,
            $request->firstName,
            $request->lastName,
        );
    }

}