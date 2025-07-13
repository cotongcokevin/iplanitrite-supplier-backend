<?php

namespace App\Enums;

enum AuthGuardType: string
{
    case ADMIN = 'admin';
    case SUPPLIER_STAFF = 'supplier_staff';
    case PARTICIPANT = 'participant';
}
