<?php

declare(strict_types=1);

namespace App\Repositories\SupplierStaffRepository\Data;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffUpdateProfileRepoData
{
    public function __construct(
        public ?string $password,
        public string $firstName,
        public string $lastName,
        public Carbon $dateOfBirth,
        public ?UuidInterface $contactNumberId,
        public ?UuidInterface $addressId,
        public ?UuidInterface $updatedBy,
        public ?Carbon $updatedAt,
    ) {}
}
