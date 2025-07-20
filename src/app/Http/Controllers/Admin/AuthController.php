<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Dto\Requests\Admin\LoginRequestResponseDto;
use App\Services\Admin\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController
{
    public function login(
        AuthService $authService,
        Request $request
    ): JsonResponse {
        return transaction(
            function () use ($authService, $request) {
                $requestDto = LoginRequestResponseDto::fromRequest($request);

                return $authService->login($requestDto);
            }
        );
    }

    public function logout(): JsonResponse
    {
        return transaction(function () {
            auth()->logout();
        });
    }
}
