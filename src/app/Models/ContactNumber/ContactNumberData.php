<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use App\Dto\Response\ContactNumberDto;

class ContactNumberData
{
    public function __construct(

    ) {}

    public function toDto(): ContactNumberDto
    {
        return new ContactNumberDto;
    }
}
