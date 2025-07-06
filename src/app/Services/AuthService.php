<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Requests\LoginRequestDto;
use App\Enums\AuthGuardType;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Auth\Guard;

class AuthService
{

    /**
     * @var Guard
     */
    private Guard $guard;

    /**
     * @param AuthFactory $auth
     */
    public function __construct(AuthFactory $auth) {
        $this->guard = $auth->guard(AuthGuardType::API->value);
    }

    /**
     * @param LoginRequestDto $request
     * @return string
     * @throws AuthenticationException
     */
    public function login(LoginRequestDto $request): string
    {
        $credentials = $request->toArray();

        $token = $this->guard->attempt($credentials);
        if ($token === false) {
            throw new AuthenticationException("Unauthenticated.");
        }

        /** @var string $token */
        return $token;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->guard->logout();
    }


}