<?php

declare(strict_types=1);

namespace App\Classes;

use App\Models\Admin\Admin;
use Illuminate\Support\Facades\App;

class Accountable
{
    private static ?Admin $admin = null;

    public static function get(): Admin
    {
        $testing = App::environment('testing');
        if (! self::$admin || $testing) {
            self::$admin = auth()->user();
        }

        return self::$admin;
    }
}
