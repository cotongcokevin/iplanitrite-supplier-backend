<?php

declare(strict_types=1);

namespace App\Models\Celebrant;

use App\Data\Dto\Response\CelebrantDto;
use Ramsey\Uuid\UuidInterface;

class CelebrantModel
{
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public string $firstName,
        public string $lastName,
        public UuidInterface $supplierId,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
    ) {}

    public function toDto(): CelebrantDto
    {
        return new CelebrantDto(
            id: $this->id,
            title: $this->title,
            firstName: $this->firstName,
            lastName: $this->lastName,
            supplierId: $this->supplierId,
            contactNumberId: $this->contactNumberId,
            addressId: $this->addressId,
        );
    }
}
