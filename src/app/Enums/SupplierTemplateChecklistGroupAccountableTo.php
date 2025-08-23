<?php

declare(strict_types=1);

namespace App\Enums;

enum SupplierTemplateChecklistGroupAccountableTo: string
{
    case CLIENT = 'CLIENT';
    case SUPPLIER = 'SUPPLIER';
}
