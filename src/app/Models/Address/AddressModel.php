<?php

declare(strict_types=1);

namespace App\Models\Address;

use App\Dto\Response\AddressDto;
use Ramsey\Uuid\UuidInterface;

class AddressModel
{
    public function __construct(
        public UuidInterface $id,
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zip,
        public ?string $lat,
        public ?string $long,
    ) {}

    public function toDto(): AddressDto
    {
        return new AddressDto(
            line1: $this->line1,
            line2: $this->line2,
            city: $this->city,
            state: $this->state,
            zip: $this->zip,
            lat: $this->lat,
            long: $this->long,
        );
    }
}
