<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSegmentTemplateCustomFieldDto extends ResponseDto
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
}
