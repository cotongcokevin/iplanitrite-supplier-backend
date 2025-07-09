<?php

declare(strict_types=1);

namespace App\Classes\Env;

class Env
{
    private static ?EnvData $env = null;

    public static function get(): EnvData
    {
        if (! self::$env) {
            self::$env = new EnvData(
                adminFrontEndURI: env('ADMIN_FRONT_END_URI'),
                organizerFrontEndURI: env('ORGANIZER_FRONT_END_URI'),
                participantFrontEndURI: env('PARTICIPANT_FRONT_END_URI'),
            );
        }

        return self::$env;
    }
}
