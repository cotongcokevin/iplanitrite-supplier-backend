<?php

declare(strict_types=1);

namespace App\Models\EventSegmentTemplate;

use App\Dto\Response\EventSegmentTemplateDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSegmentTemplateModel
{
    public function __construct(
        public UuidInterface $id,
        public string $eventType,
        public string $templateName,
        public bool $isImmutable,
        public bool $isRsvp,
        public UuidInterface $supplierId,
        public ?string $defaultNameLabel,
        public ?string $defaultLocationLabel,
        public ?string $defaultAddressLabel,
        public ?string $defaultNotesLabel,
        public ?string $defaultDateFromLabel,
        public ?string $defaultDateToLabel,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}

    public function toDto(): EventSegmentTemplateDto
    {
        return new EventSegmentTemplateDto(
            id: $this->id,
            eventType: $this->eventType,
            templateName: $this->templateName,
            isImmutable: $this->isImmutable,
            isRsvp: $this->isRsvp,
            supplierId: $this->supplierId,
            defaultNameLabel: $this->defaultNameLabel,
            defaultLocationLabel: $this->defaultLocationLabel,
            defaultAddressLabel: $this->defaultAddressLabel,
            defaultNotesLabel: $this->defaultNotesLabel,
            defaultDateFromLabel: $this->defaultDateFromLabel,
            defaultDateToLabel: $this->defaultDateToLabel,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
