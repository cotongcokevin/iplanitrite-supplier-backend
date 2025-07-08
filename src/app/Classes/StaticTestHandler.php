<?php

declare(strict_types=1);

namespace App\Classes;

use App\Models\Admin\Admin;
use Illuminate\Support\Facades\App;

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
        $testing = App::environment('testing');

        return ! $testing
            ? static::handle()
            : static::handleTest();
    }
}
