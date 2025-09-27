<?php

namespace App\Services;

use App\Repositories\RsvpGuestGroupRepository\RsvpGuestGroupRepository;

readonly class RsvpGuestGroupService
{
    public function __construct(
        private RsvpGuestGroupRepository $rsvpGuestGroupRepository
    ) {}
}
