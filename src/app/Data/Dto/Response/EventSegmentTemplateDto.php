<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Data\Udf\UdfTemplate;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSegmentTemplateDto extends ResponseDto
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
}
