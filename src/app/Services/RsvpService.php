<?php

namespace App\Services;

use App\Repositories\RsvpRepository\RsvpRepository;
use Ramsey\Uuid\UuidInterface;

class RsvpService
{

    public function __construct(
        private RsvpRepository $rsvpRepository,
        private RsvpGuestGroupService $rspvGuestGroupService
    ) {}

    public function create(
        UuidInterface $scheduleId,
        int $guestsCount
    ): void
    {
        $rsvp = $this->rsvpRepository->create(
            $scheduleId,
            $guestsCount
        );

        $this->rspvGuestGroupService->create(
            $rsvp->id,
            "All Guests"
        );
    }
}