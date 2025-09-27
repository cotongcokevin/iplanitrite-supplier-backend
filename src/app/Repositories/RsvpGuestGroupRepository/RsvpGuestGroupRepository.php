<?php

declare(strict_types=1);

namespace App\Repositories\RsvpGuestGroupRepository;

use App\Classes\Principals\Principal;

readonly class RsvpGuestGroupRepository
{
    public function __construct(
        private Principal $principal
    ) {}
}
