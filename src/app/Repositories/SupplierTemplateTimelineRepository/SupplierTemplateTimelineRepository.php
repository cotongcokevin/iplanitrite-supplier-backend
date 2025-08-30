<?php

declare(strict_types=1);

namespace App\Repositories\SupplierTemplateTimelineRepository;

use App\Classes\Principals\Principal;
use App\Enums\EventType;
use App\Models\SupplierTemplateTimeline\SupplierTemplateTimelineEntity;
use App\Models\SupplierTemplateTimeline\SupplierTemplateTimelineModel;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierTemplateTimelineRepository
{

    public function __construct(
        private Principal $principal
    ) {}

    /**
     * @param EventType $eventType
     * @return Collection<SupplierTemplateTimelineModel>
     */
    public function getByEventType(EventType $eventType): Collection {
        return SupplierTemplateTimelineEntity::where("event_type", $eventType)
            ->get()
            ->map(fn(SupplierTemplateTimelineEntity $entity) => $entity->toModel());
    }

    public function create(
        string $name,
        bool $isRsvp,
        EventType $eventType,
    ): void {
        $entity = new SupplierTemplateTimelineEntity();
        $entity->id = Uuid::uuid4();
        $entity->name = $name;
        $entity->is_rsvp = $isRsvp;
        $entity->is_main_event = false;
        $entity->event_type = $eventType;
        $entity->supplier_id = $this->principal::get()->guardId;
        $entity->created_by = $this->principal::get()->id;
        $entity->created_at = now();
        $entity->save();
    }

    public function update(
        UuidInterface $id,
        string $name,
        bool $isRsvp,
    ): void {
        $entity = SupplierTemplateTimelineEntity::where("id", $id)->first();
        $entity->name = $name;
        $entity->is_rsvp = $isRsvp;
        $entity->updated_by = $this->principal::get()->id;
        $entity->updated_at = now();
        $entity->save();
    }

    public function destroy(UuidInterface $id): void {
        $entity = SupplierTemplateTimelineEntity::where("id", $id)
            ->where("is_main_event", false)
            ->first();

        $entity->delete();
    }

}
