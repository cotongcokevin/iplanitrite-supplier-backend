<?php

namespace App\Enums;

enum AuthGuardType: string
{
    case ADMIN = 'admin';
    case ORGANIZER = 'organizer';
    case PARTICIPANT = 'participant';
}
