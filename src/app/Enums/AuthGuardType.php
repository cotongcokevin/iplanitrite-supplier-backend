<?php

namespace App\Enums;

enum AuthGuardType: string
{
    case ADMIN = 'admin';
    case ORGANIZER_STAFF = 'organizer_staff';
    case PARTICIPANT = 'participant';
}
