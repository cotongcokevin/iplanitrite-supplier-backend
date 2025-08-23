<?php

declare(strict_types=1);

namespace App\Classes\Env;

use App\Enums\EnvironmentType;
use Ramsey\Uuid\Uuid;

class Env
{
    private static ?EnvData $env = null;

    public static function get(): EnvData
    {
        if (! self::$env) {
            self::$env = new EnvData(
                environment: EnvironmentType::from(env('APP_ENV')),
                frontEndURI: env('FRONT_END_URI'),
                countryId: Uuid::fromString(env('COUNTRY_ID')),
                jwtTokenName: env('JWT_TOKEN_NAME'),
                jwtTTL: (int) env('JWT_TTL')
            );
        }

        return self::$env;
    }
}
