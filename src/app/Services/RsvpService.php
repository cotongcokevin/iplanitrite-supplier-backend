<?php

namespace App\Services;

use App\Repositories\RsvpRepository\RsvpRepository;
use Ramsey\Uuid\UuidInterface;

readonly class RsvpService
{
    public function __construct(
        private RsvpRepository $rsvpRepository
    ) {}

    public function create(
        UuidInterface $scheduleId,
        int $guestsCount
    ): void {
        $this->rsvpRepository->create(
            $scheduleId,
            $guestsCount
        );
    }
}
