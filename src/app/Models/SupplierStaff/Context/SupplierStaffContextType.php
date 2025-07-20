<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff\Context;

enum SupplierStaffContextType: string
{
    case ADDRESS = 'address';
    case CONTACT_NUMBER = 'contactNumber';
}
