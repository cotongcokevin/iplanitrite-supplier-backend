<?php

declare(strict_types=1);

namespace App\Http\Middlewares;

use App\Classes\Env\Env;
use Closure;
use JWTAuth;

class JWTCookie
{
    public function handle($request, Closure $next)
    {
        $tokenName = Env::get()->jwtTokenName;
        if ($request->hasCookie(Env::get()->jwtTokenName)) {
            $token = $request->cookie($tokenName);
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}