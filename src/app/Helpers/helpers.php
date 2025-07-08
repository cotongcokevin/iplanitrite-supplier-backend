<?php

declare(strict_types=1);

use App\Dto\Response\ExceptionCodeDto;
use App\Enums\ExceptionCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

function transaction(Closure $closure): JsonResponse {
    try {
        DB::beginTransaction();
        $result = $closure();
        DB::commit();

        return $result ? response()->json($result) : response()->json();
    }
    catch(AuthenticationException $e) {
        try { DB::rollBack(); } catch (Throwable $e) { logError($e); }
        logError($e);

        return response()->json(
            new ExceptionCodeDto(ExceptionCode::UNAUTHORIZED),
            Response::HTTP_UNAUTHORIZED
        );
    }
    catch(QueryException $e) {
        try { DB::rollBack(); } catch (Throwable $e) { logError($e); }
        logError($e);

        return response()->json(
            new ExceptionCodeDto(ExceptionCode::QUERY),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
    catch(Throwable $e) {
        try { DB::rollBack(); } catch (Throwable $e) { logError($e); }
        logError($e);

        return response()->json(
            new ExceptionCodeDto(ExceptionCode::THROWABLE),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}

function logError(Throwable $e) {

}