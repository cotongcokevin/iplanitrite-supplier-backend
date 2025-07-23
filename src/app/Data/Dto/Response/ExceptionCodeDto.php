<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Enums\ExceptionCode;

class ExceptionCodeDto extends ResponseDto
{
    public string $code;

    public string $message;

    public function __construct(ExceptionCode $code, string $message)
    {
        $this->code = $code->value;
        $this->message = $message;
    }
}
