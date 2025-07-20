<?php

declare(strict_types=1);

namespace App\Enums;

enum EventSegmentTemplateCustomFieldType: string
{
    case TEXTBOX = 'TEXTBOX';
    case TEXTAREA = 'TEXTAREA';
    case DROPDOWN_SINGLE = 'DROPDOWN_SINGLE';
    case DROPDOWN_MULTI = 'DROPDOWN_MULTI';
    case DATE = 'DATE';
    case DATETIME = 'DATETIME';
    case ADDRESS = 'ADDRESS';
    case CHECKBOX = 'CHECKBOX';
}
