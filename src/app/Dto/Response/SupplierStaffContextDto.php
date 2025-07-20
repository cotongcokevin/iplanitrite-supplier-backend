<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Classes\ContextDto;

class SupplierStaffContextDto extends ContextDto
{
    public function __construct(
        public ?AddressDto $address,
        public ?ContactNumberDto $contactNumber,
    ) {}
}
