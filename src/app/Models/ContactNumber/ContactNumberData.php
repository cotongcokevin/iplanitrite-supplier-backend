<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use App\Dto\Response\ContactNumberDto;
use Ramsey\Uuid\UuidInterface;

class ContactNumberData
{
    public function __construct(
        public UuidInterface $id,
        public string $phoneNumber,
    ) {}

    public function toDto(): ContactNumberDto
    {
        return new ContactNumberDto(
            id: $this->id,
            phoneNumber: $this->phoneNumber,
        );
    }
}
