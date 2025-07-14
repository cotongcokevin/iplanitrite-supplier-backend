<?php

declare(strict_types=1);

namespace App\Classes\Principals;

use App\Classes\StaticTestHandler;
use App\Models\SupplierStaff\SupplierStaff;

class SupplierStaffPrincipal extends StaticTestHandler
{
    private static ?PrincipalData $staff = null;

    public static function handle(): PrincipalData
    {
        if (! self::$staff) {
            /** @var SupplierStaff $staff */
            $staff = auth()->user();
            self::$staff = $staff->toPrincipalData();
        }

        return self::$staff;
    }

    protected static function handleTest(): PrincipalData
    {
        /** @var SupplierStaff $staff */
        $staff = auth()->user();

        return $staff->toPrincipalData();
    }
}
