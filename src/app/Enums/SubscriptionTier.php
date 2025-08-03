<?php

declare(strict_types=1);

namespace App\Enums;

enum SubscriptionTier: string
{
    case BASIC = 'BASIC';
    case STANDARD = 'STANDARD';
    case PREMIUM = 'PREMIUM';
}
