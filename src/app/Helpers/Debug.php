<?php

namespace App\Helpers;

use JetBrains\PhpStorm\NoReturn;

class Debug
{

    /**
     * @param mixed $data
     * @return void
     */
    #[NoReturn] public static function dumpDie(mixed $data): void {
        var_dump($data);
        die();
    }

}