<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Env\Env;
use App\Data\Dto\Requests\LoginRequestDto;
use App\Services\Admin\AuthService;
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
            ->cookie('ems_sec_token', $token, Env::get()->jwtTTL, '/', null, true, true) // Secure, HttpOnly
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
