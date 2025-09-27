<?php

namespace App\Services;

use App\Models\RsvpGuestGroup\RsvpGuestGroupModel;
use App\Repositories\RsvpGuestGroupRepository\RsvpGuestGroupRepository;
use Ramsey\Uuid\UuidInterface;

class RsvpGuestGroupService
{
    public function __construct(
        private RsvpGuestGroupRepository $rsvpGuestGroupRepository
    ) {}

    public function create(
        UuidInterface $rsvpId,
        string $name,
    ): RsvpGuestGroupModel {
        return $this->rsvpGuestGroupRepository->create(
            $rsvpId,
            $name
        );
    }
}
