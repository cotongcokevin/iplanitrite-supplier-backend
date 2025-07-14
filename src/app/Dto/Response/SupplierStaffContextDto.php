<?php

declare(strict_types=1);

namespace App\Dto\Response;

class SupplierStaffContextDto
{
    public function __construct(
        public ?AddressDto $address,
        public ?ContactNumberDto $contactNumber,
    ) {}
}
