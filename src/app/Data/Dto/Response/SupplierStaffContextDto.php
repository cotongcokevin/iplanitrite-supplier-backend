<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseContext;

class SupplierStaffContextDto extends ResponseContext
{
    public function __construct(
        public ?AddressDto $address,
        public ?ContactNumberDto $contactNumber,
    ) {}
}
