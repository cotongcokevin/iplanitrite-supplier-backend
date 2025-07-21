<?php

declare(strict_types=1);

namespace App\Enums;

enum EventSupplierStatus: string
{
    case PENDING = 'PENDING';
    case CANCELLED = 'CANCELLED';
    case APPROVED = 'APPROVED';
    case FINISHED = 'FINISHED';
}
