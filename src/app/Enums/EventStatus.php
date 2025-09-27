<?php

declare(strict_types=1);

namespace App\Enums;

enum EventStatus: string
{
    case PENDING = 'PENDING';
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';
    case FINISHED = 'FINISHED';
}
