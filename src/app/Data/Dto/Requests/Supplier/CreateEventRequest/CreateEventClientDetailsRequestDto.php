<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Supplier\CreateEventRequest;

class CreateEventClientDetailsRequestDto
{
    private function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {}

}
