<?php

declare(strict_types=1);

namespace App\Enums;

enum ExceptionCode: string
{
    case QUERY = '1';
    case THROWABLE = '2';
    case UNAUTHORIZED = '3';
}
