<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff\Context;

use App\Dto\Response\SupplierStaffContextDto;
use App\Models\Address\AddressModel;
use App\Models\ContactNumber\ContactNumberModel;

readonly class SupplierStaffContext
{
    public function __construct(
        private ?AddressModel $address,
        private ?ContactNumberModel $contactNumber,
    ) {}

    public function toDto(): SupplierStaffContextDto
    {
        return new SupplierStaffContextDto(
            $this->address?->toDto(),
            $this->contactNumber?->toDto(),
        );
    }
}
