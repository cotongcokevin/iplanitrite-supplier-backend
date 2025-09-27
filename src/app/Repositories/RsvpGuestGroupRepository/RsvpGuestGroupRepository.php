<?php

declare(strict_types=1);

namespace App\Repositories\RsvpGuestGroupRepository;

use App\Classes\Principals\Principal;
use App\Models\RsvpGuestGroup\RsvpGuestGroupEntity;
use App\Models\RsvpGuestGroup\RsvpGuestGroupModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class RsvpGuestGroupRepository
{

    public function __construct(
        private Principal $principal
    ) {}

    public function create(
        UuidInterface $rsvpId,
        string $name,
    ): RsvpGuestGroupModel {
        $entity = new RsvpGuestGroupEntity();
        $entity->id = Uuid::uuid4();
        $entity->name = $name;
        $entity->rsvp_id = $rsvpId;
        $entity->created_at = Carbon::now();
        $entity->created_by = $this->principal::get()->id;
        $entity->save();

        return $entity->toModel();
    }

}
