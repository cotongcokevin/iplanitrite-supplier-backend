<?php

namespace App\Enums;

enum EventInvoiceStatus: string
{
    case PENDING = 'PENDING';
    case PAID = 'PAID';
    case CANCELLED = 'CANCELLED';
}
