<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Data\Dto\Requests\Admin\LoginRequestResponseDto;
use App\Enums\AuthGuardType;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Auth\Guard;

class AuthService
{
    private Guard $guard;

    public function __construct(AuthFactory $auth)
    {
        $this->guard = $auth->guard(AuthGuardType::CLIENT->value);
    }

    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequestResponseDto $request): string
    {
        $token = $this->guard->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if ($token === false) {
            throw new AuthenticationException('Unauthenticated.');
        }

        /** @var string $token */
        return $token;
    }

    public function logout(): void
    {
        $this->guard->logout();
    }
}
