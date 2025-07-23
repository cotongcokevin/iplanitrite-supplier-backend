<?php

declare(strict_types=1);

namespace App\Models\EventSegmentTemplate;

use App\Data\Dto\Response\EventSegmentTemplateDto;
use App\Data\Udf\UdfTemplate;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSegmentTemplateModel
{
    /**
     * @param  UdfTemplate[]|null  $udf
     */
    public function __construct(
        public UuidInterface $id,
        public string $eventType,
        public string $templateName,
        public bool $isImmutable,
        public bool $isRsvp,
        public bool $onField,
        public UuidInterface $supplierId,
        public ?string $defaultLocationLabel,
        public ?string $defaultAddressLabel,
        public ?string $defaultNotesLabel,
        public ?string $defaultDateFromLabel,
        public ?string $defaultDateToLabel,
        public ?array $udf,
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
            onField: $this->onField,
            supplierId: $this->supplierId,
            defaultLocationLabel: $this->defaultLocationLabel,
            defaultAddressLabel: $this->defaultAddressLabel,
            defaultNotesLabel: $this->defaultNotesLabel,
            defaultDateFromLabel: $this->defaultDateFromLabel,
            defaultDateToLabel: $this->defaultDateToLabel,
            udf: $this->udf,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
