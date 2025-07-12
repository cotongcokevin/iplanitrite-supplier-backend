<?php

declare(strict_types=1);

namespace App\Classes;

use App\Classes\Env\Env;
use App\Enums\EnvironmentType;
use App\Models\Admin\Admin;

/**
 * When doing tests static doesn't reset
 * Add the special handleTest to have a separate way to return the data.
 */
abstract class StaticTestHandler
{
    abstract protected static function handle();

    abstract protected static function handleTest();

    public static function get(): Admin
    {
        $testing = Env::get()->environment === EnvironmentType::TESTING;

        return ! $testing
            ? static::handle()
            : static::handleTest();
    }
}
