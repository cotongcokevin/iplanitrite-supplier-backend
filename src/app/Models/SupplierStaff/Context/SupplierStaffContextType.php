<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff\Context;

enum SupplierStaffContextType: string
{
    case ADDRESS = 'address';
    case CONTACT_NUMBER = 'contactNumber';

    /**
     * Convert an array of enum cases to an array of their string values.
     *
     * @param  self[]  $contexts
     * @return string[]
     */
    public static function toValues(array $contexts): array
    {
        return array_map(
            fn (self $context): string => $context->value,
            $contexts
        );
    }
}
