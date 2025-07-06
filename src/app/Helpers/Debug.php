<?php

namespace App\Helpers;

use JetBrains\PhpStorm\NoReturn;

class Debug
{
    #[NoReturn]
    public static function dumpDie(mixed $data): void
    {
        var_dump($data);
        exit();
    }
}
