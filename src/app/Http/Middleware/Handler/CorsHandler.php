<?php

declare(strict_types=1);

namespace App\Http\Middleware\Handler;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CorsHandler
{
    public static function handle(
        string $allowedOrigin,
        Request $request,
        Closure $next
    ): Response {
        // Create a basic response, for OPTIONS requests it will be empty
        if ($request->getMethod() === 'OPTIONS') {
            $response = response('', 204);
        } else {
            $response = $next($request);
        }

        $response->headers->set('Access-Control-Allow-Origin', $allowedOrigin);
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
