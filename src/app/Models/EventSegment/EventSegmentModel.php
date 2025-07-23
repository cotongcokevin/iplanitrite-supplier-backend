<?php

declare(strict_types=1);

namespace App\Models\EventSegment;

use App\Data\Dto\Response\EventSegmentDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSegmentModel
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $locationLabel,
        public ?string $location,
        public string $addressLabel,
        public ?UuidInterface $addressId,
        public string $notesLabel,
        public ?string $notes,
        public string $dateFromLabel,
        public ?Carbon $dateFrom,
        public string $dateToLabel,
        public ?Carbon $dateTo,
        public ?[convertMeToDto] $udf,
        public UuidInterface $eventSegmentTemplateId,
        public UuidInterface $eventId,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventSegmentDto
    {
        return new EventSegmentDto(
            id: $this->id,
            name: $this->name,
            locationLabel: $this->locationLabel,
            location: $this->location,
            addressLabel: $this->addressLabel,
            addressId: $this->addressId,
            notesLabel: $this->notesLabel,
            notes: $this->notes,
            dateFromLabel: $this->dateFromLabel,
            dateFrom: $this->dateFrom,
            dateToLabel: $this->dateToLabel,
            dateTo: $this->dateTo,
            udf: $this->udf,
            eventSegmentTemplateId: $this->eventSegmentTemplateId,
            eventId: $this->eventId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
