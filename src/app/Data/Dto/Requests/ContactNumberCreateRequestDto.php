<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Ramsey\Uuid\UuidInterface;

class ContactNumberCreateRequestDto
{
    public function __construct(
        public string $number,
        public UuidInterface $countryId,
    ) {}

}
