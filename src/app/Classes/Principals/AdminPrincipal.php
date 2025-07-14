<?php

declare(strict_types=1);

namespace App\Classes\Principals;

use App\Classes\StaticTestHandler;
use App\Models\Admin\Admin;

class AdminPrincipal extends StaticTestHandler
{
    private static ?PrincipalData $admin = null;

    public static function handle(): PrincipalData
    {
        if (! self::$admin) {
            /** @var Admin $admin */
            $admin = auth()->user();
            self::$admin = $admin->toPrincipalData();
        }

        return self::$admin;
    }

    protected static function handleTest(): PrincipalData
    {
        /** @var Admin $admin */
        $admin = auth()->user();

        return $admin->toPrincipalData();
    }
}
