<?php

declare(strict_types=1);

namespace App\Dto\Requests;

class AddressRequestDto
{
    public function __construct(
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zip,
        public ?string $lat,
        public ?string $long,
    ) {}
}
