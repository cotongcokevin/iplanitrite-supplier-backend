<?php

declare(strict_types=1);

namespace App\Models\EventSegmentTemplateCustomField;

use App\Dto\Response\EventSegmentTemplateCustomFieldDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSegmentTemplateCustomFieldModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $type,
        public bool $required,
        public ?UuidInterface $eventSegmentId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): EventSegmentTemplateCustomFieldDto
    {
        return new EventSegmentTemplateCustomFieldDto(
            id: $this->id,
            name: $this->name,
            type: $this->type,
            required: $this->required,
            eventSegmentId: $this->eventSegmentId,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
