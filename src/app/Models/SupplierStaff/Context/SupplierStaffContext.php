<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff\Context;

use App\Dto\Response\SupplierStaffContextDto;
use App\Models\Address\AddressModel;
use App\Models\ContactNumber\ContactNumberModel;
use BackedEnum;

readonly class SupplierStaffContext
{
    public function __construct(
        private ?AddressModel $address,
        private ?ContactNumberModel $contactNumber,
    ) {}

    /**
     * @param  BackedEnum[]  $expectedContexts
     */
    public function toDto(array $expectedContexts): SupplierStaffContextDto
    {
        $result = new SupplierStaffContextDto(
            $this->address?->toDto(),
            $this->contactNumber?->toDto(),
        );

        $result->setExpectedContexts($expectedContexts);

        return $result;
    }
}
