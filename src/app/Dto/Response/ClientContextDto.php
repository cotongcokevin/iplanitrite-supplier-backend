<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\ResponseContext;

class ClientContextDto extends ResponseContext
{
    public function __construct(
        public ?ContactNumberDto $contactNumber,
    ) {}
}
