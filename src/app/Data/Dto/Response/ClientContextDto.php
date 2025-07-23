<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseContext;

class ClientContextDto extends ResponseContext
{
    public function __construct(
        public ?ContactNumberDto $contactNumber,
    ) {}
}
