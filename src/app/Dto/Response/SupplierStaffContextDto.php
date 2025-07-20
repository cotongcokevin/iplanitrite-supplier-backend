<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\ResponseContext;

class SupplierStaffContextDto extends ResponseContext
{
    public function __construct(
        public ?AddressDto $address,
        public ?ContactNumberDto $contactNumber,
    ) {}
}
