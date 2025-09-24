<?php

declare(strict_types=1);

namespace App\Models\Schedule;

use App\Data\Dto\Response\ScheduleDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ScheduleModel
{
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public Carbon $startDate,
        public Carbon $endDate,
        public ?string $notes,
        public string $type,
        public bool $isMandatory,
        public ?UuidInterface $eventId,
        public ?UuidInterface $addressId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): ScheduleDto
    {
        return new ScheduleDto(
            id: $this->id,
            title: $this->title,
            startDate: $this->startDate,
            endDate: $this->endDate,
            notes: $this->notes,
            type: $this->type,
            isMandatory: $this->isMandatory,
            eventId: $this->eventId,
            addressId: $this->addressId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
