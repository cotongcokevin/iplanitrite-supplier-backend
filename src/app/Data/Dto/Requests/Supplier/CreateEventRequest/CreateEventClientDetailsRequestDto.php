<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Supplier\CreateEventRequest;

use App\Data\Dto\Requests\NameRequestDto;
use App\Enums\EventType;
use Carbon\Carbon;

class CreateEventClientDetailsRequestDto
{

    private function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {}

}