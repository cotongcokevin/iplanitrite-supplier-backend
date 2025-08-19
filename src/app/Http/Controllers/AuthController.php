<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Env\Env;
use App\Data\Dto\Requests\LoginRequestDto;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController
{
    public function login(
        AuthService $authService,
        Request $request
    ): JsonResponse {
        $requestDto = LoginRequestDto::fromRequest($request);
        $token = $authService->login($requestDto);

        return response()->json($token)
            ->cookie(
                Env::get()->jwtTokenName,
                $token,
                Env::get()->jwtTTL,
                '/',    // path
                null,   // domain = null
                false,  // secure
                true,   // httpOnly
                false,  // raw
                'Lax'   // sameSite
            )
            ->header('Access-Control-Allow-Origin', Env::get()->adminFrontEndURI)
            ->header('Access-Control-Allow-Credentials', 'true');
    }

    public function logout(): JsonResponse
    {
        return transaction(function () {
            auth()->logout();
        });
    }
}
