<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;

class ContactNumberDto extends ResponseDto
{
    public function __construct(
        public string $number,
    ) {}
}
