<?php

namespace App\Enums;

enum AuthGuardType: string
{
    case ADMIN = 'ADMIN';
    case SUPPLIER_STAFF = 'SUPPLIER_STAFF';
    case CLIENT = 'CLIENT';
}
