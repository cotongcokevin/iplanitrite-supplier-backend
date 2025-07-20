<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\ResponseDto;
use App\Enums\ExceptionCode;

class ExceptionCodeDto extends ResponseDto
{
    public string $code;

    public function __construct(ExceptionCode $code)
    {
        $this->code = $code->value;
    }
}
