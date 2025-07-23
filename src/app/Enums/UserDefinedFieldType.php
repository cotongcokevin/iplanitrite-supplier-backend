<?php

declare(strict_types=1);

namespace App\Enums;

enum UserDefinedFieldType: string
{
    case TEXTBOX = 'TEXTBOX';
    case NUMBER = 'NUMBER';
    case TEXTAREA = 'TEXTAREA';
    case DROPDOWN_SINGLE = 'DROPDOWN_SINGLE';
    case DROPDOWN_MULTI = 'DROPDOWN_MULTI';
    case DATE = 'DATE';
    case DATETIME = 'DATETIME';
    case ADDRESS = 'ADDRESS';
    case CHECKBOX = 'CHECKBOX';
    case CONTACT_NUMBER = 'CONTACT_NUMBER';
    case COLOR_PALETTE = 'COLOR_PALETTE';
}
