<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\LoginRequestDto;
use App\Enums\AuthGuardType;
use App\Helpers\Debug;
use Illuminate\Auth\AuthenticationException;

class AuthService
{

    /**
     * @param LoginRequestDto $request
     * @return string
     * @throws AuthenticationException
     */
    public function login(LoginRequestDto $request): string {

        $credentials = $request->toArray();

        $guard = auth(AuthGuardType::API->value);
        $token = $guard->attempt($credentials);
        if ($token === false) {
            throw new AuthenticationException("Unauthenticated.");
        }

        /** @var string $token */
        return $token;
    }

}