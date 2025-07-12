<?php

declare(strict_types=1);

namespace App\Enums;

enum EnvironmentType: string
{
    case TESTING = 'testing';
    case LOCAL = 'local';
    case PRODUCTION = 'production';
}
