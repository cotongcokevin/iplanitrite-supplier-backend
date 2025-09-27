<?php

declare(strict_types=1);

namespace App\Repositories\EventRepository;

use App\Classes\Principals\Principal;
use App\Enums\EventStatus;
use App\Models\Event\EventEntity;
use App\Models\Event\EventModel;
use App\Repositories\EventRepository\Data\EventCreateRepoData;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class EventRepository
{
    public function __construct(private Principal $principal) {}

    public function create(EventCreateRepoData $data): EventModel
    {
        $id = Uuid::uuid4();

        $eventEntity = new EventEntity;
        $eventEntity->id = $id;
        $eventEntity->name = $data->name;
        $eventEntity->type = $data->type->value;
        $eventEntity->notes = $data->notes;
        $eventEntity->status = $data->status->value;
        $eventEntity->celebrant_one = $data->celebrantOne;
        $eventEntity->celebrant_two = $data->celebrantTwo;
        $eventEntity->client_id = $data->clientId;
        $eventEntity->created_by = $this->principal::get()->id;
        $eventEntity->created_at = Carbon::now();
        $eventEntity->save();

        return $eventEntity->toModel();
    }

    public function updateStatus(
        EventStatus $status,
        UuidInterface $eventId
    ): void {
        $entity = EventEntity::where("id", $eventId)->first();
        $entity->status = $status;
        $entity->save();
    }
}
