<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class CelebrantDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $firstName,
        public string $lastName,
        public ?Carbon $dateOfBirth,
        public ?UuidInterface $clientId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
