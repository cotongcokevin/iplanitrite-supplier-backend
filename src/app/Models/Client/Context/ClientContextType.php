<?php

declare(strict_types=1);

namespace App\Models\Client\Context;

enum ClientContextType: string
{
    case CONTACT_NUMBER = 'contactNumber';
}
