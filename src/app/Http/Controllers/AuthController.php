<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\LoginRequestDto;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController
{

    /**
     * @param AuthService $authService
     * @param Request $request
     * @return JsonResponse
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

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse {
        return response()->json(auth()->id());
    }

}