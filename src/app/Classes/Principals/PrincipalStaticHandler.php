<?php

declare(strict_types=1);

namespace App\Classes\Principals;

use App\Classes\Env\Env;
use App\Enums\EnvironmentType;

/**
 * When doing tests static doesn't reset
 * Add the special handleTest to have a separate way to return the data.
 */
abstract class PrincipalStaticHandler
{
    abstract protected static function handle(): PrincipalData;

    abstract protected static function handleTest(): PrincipalData;

    public static function get(): PrincipalData
    {
        $testing = Env::get()->environment === EnvironmentType::TESTING;

        return ! $testing
            ? static::handle()
            : static::handleTest();
    }
}
