<?php

declare(strict_types=1);

namespace App\Enums;

enum EventType: string
{
    case WEDDING = 'WEDDING';
    case BAPTISM = 'BAPTISM';
    case ENGAGEMENT = 'ENGAGEMENT';
    case BRIDAL_SHOWER = 'BRIDAL_SHOWER';
    case BABY_SHOWER = 'BABY_SHOWER';
    case DEBUT = 'DEBUT';
    case BIRTHDAY = 'BIRTHDAY';
    case ANNIVERSARY = 'ANNIVERSARY';
    case ANNIVERSARY_COUPLE = 'ANNIVERSARY_COUPLE';
    case CORPORATE_EVENT = 'CORPORATE_EVENT';
}
