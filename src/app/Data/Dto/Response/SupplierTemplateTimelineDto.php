<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class SupplierTemplateTimelineDto extends ResponseDto
{
    
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public bool $isRsvp,
        public bool $isMainEvent,
        public string $eventType,
        public UuidInterface $supplierId,
        public UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}
}
