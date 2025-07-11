<?php

declare(strict_types=1);

namespace App\Models\OrganizerStaff;

use App\Dto\Response\OrganizerStaffDto;

class OrganizerStaffData
{
    public function __construct(

    ) {}

    public function toDto(): OrganizerStaffDto
    {
        return new OrganizerStaffDto;
    }
}
