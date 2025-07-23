<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use App\Data\Dto\Response\ContactNumberDto;
use Ramsey\Uuid\UuidInterface;

class ContactNumberModel
{
    public function __construct(
        public UuidInterface $id,
        public string $number,
    ) {}

    public function toDto(): ContactNumberDto
    {
        return new ContactNumberDto(
            number: $this->number,
        );
    }
}
