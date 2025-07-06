<?php

declare(strict_types=1);

namespace App\Classes;

use App\Models\Admin\Admin;

class Accountable
{

    /**
     * @var ?Admin
     */
    public static ?Admin $admin = null;

    /**
     * @return Admin
     */
    public static function data(): Admin {
        if(self::$admin === null) {
            self::$admin = auth()->user();
        }

        return self::$admin;
    }

}