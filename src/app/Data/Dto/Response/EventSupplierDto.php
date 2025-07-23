<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class EventSupplierDto extends ResponseDto
{
    
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $status,
        public ?string $reasonForCancellation,
        public UuidInterface $supplierId,
        public UuidInterface $eventId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}
}
