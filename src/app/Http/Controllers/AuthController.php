<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\Requests\LoginRequestDto;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController
{
    /**
     * @throws AuthenticationException
     */
    public function login(
        AuthService $authService,
        Request $request
    ): JsonResponse {
        $requestDto = LoginRequestDto::fromRequest($request);
        $token = $authService->login($requestDto);

        return response()->json(
            $token
        );
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json();
    }
}
