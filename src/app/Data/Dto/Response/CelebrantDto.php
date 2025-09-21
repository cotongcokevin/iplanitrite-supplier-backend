<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class CelebrantDto extends ResponseDto
{
    
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public string $name,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
    ) {}
}
