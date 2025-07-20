<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\ResponseDto;

class ContactNumberDto extends ResponseDto
{
    public function __construct(
        public string $number,
    ) {}
}
