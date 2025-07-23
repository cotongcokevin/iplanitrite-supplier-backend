<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class EventSegmentDto extends ResponseDto
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
}
