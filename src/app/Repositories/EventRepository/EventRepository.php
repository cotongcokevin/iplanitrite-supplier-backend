<?php

declare(strict_types=1);

namespace App\Repositories\EventRepository;

use App\Classes\Principals\Principal;
use App\Models\Event\EventEntity;
use App\Repositories\EventRepository\Data\EventCreateRepoData;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class EventRepository
{
    public function __construct(private Principal $principal) {}

    public function create(EventCreateRepoData $data): UuidInterface
    {
        $id = Uuid::uuid4();

        $eventEntity = new EventEntity;
        $eventEntity->id = $id;
        $eventEntity->name = $data->name;
        $eventEntity->type = $data->type;
        $eventEntity->notes = $data->notes;
        $eventEntity->client_id = $data->clientId;
        $eventEntity->created_by = $this->principal::get()->id;
        $eventEntity->created_at = Carbon::now();
        $eventEntity->save();

        return $id;
    }
}
