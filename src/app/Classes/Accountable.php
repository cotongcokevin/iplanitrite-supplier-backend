<?php

declare(strict_types=1);

namespace App\Classes;

use App\Models\Admin\Admin;

class Accountable extends StaticTestHandler
{
    private static ?Admin $admin = null;

    public static function handle(): Admin
    {
        if (! self::$admin) {
            self::$admin = auth()->user();
        }

        return self::$admin;
    }

    protected static function handleTest(): Admin
    {
        return auth()->user();
    }
}
