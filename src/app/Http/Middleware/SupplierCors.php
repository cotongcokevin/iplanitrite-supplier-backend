<?php

namespace App\Http\Middleware;

use App\Classes\Env\Env;
use App\Http\Middleware\Handler\CorsHandler;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierCors
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return CorsHandler::handle(
            Env::get()->supplierFrontEndURI,
            $request,
            $next
        );
    }
}
