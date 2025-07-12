<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Ramsey\Uuid\UuidInterface;

class ContactNumberDto
{
    public function __construct(
        public UuidInterface $id,
        public string $phoneNumber,
    ) {}
}
