<?php

declare(strict_types=1);

namespace App\Http\Middleware\Handler;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsHandler
{
    public static function handle(
        string $allowedOrigin,
        Request $request,
        Closure $next
    ): Response {
        $origin = $request->headers->get('Origin');
        if ($origin !== $allowedOrigin) {
            return $next($request);
        }

        // Create a basic response, for OPTIONS requests it will be empty
        $response = $request->getMethod() === 'OPTIONS'
            ? response('', Response::HTTP_NO_CONTENT)
            : $next($request);

        $response->headers->set('Access-Control-Allow-Origin', $allowedOrigin);
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
