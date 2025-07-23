<?php

declare(strict_types=1);

namespace App\Classes\Principals;

use App\Models\Admin\AdminEntity;
use App\Models\Client\ClientEntity;
use App\Models\SupplierStaff\SupplierStaffEntity;

class Principal extends PrincipalStaticHandler
{
    private static ?PrincipalData $principal = null;

    /**
     * @throws PrincipalException
     */
    public static function handle(): PrincipalData
    {
        if (! self::$principal) {
            self::$principal = self::getPrincipal();
        }

        return self::$principal;
    }

    /**
     * @throws PrincipalException
     */
    protected static function handleTest(): PrincipalData
    {
        return self::getPrincipal();
    }

    /**
     * @throws PrincipalException
     */
    private static function getPrincipal(): PrincipalData
    {
        $user = auth()->user();

        return match (true) {
            $user instanceof AdminEntity => $user->toPrincipalData(),
            $user instanceof SupplierStaffEntity => $user->toPrincipalData(),
            $user instanceof ClientEntity => $user->toPrincipalData(),
            default => throw new PrincipalException('Invalid principal')
        };
    }
}
