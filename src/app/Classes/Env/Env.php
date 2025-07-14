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
                adminFrontEndURI: env('ADMIN_FRONT_END_URI'),
                supplierFrontEndURI: env('SUPPLIER_FRONT_END_URI'),
                participantFrontEndURI: env('PARTICIPANT_FRONT_END_URI'),
                countryId: Uuid::fromString(env('COUNTRY_ID'))
            );
        }

        return self::$env;
    }
}
