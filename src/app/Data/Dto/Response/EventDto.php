<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $status,
        public string $name,
        public string $type,
        public UuidInterface $clientId,
        public UuidInterface $celebrantOne,
        public UuidInterface $celebrantTwo,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
