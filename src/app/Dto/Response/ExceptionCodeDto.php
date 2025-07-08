<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Enums\ExceptionCode;

class ExceptionCodeDto
{

    /**
     * @var string
     */
    public string $code;

    public function __construct(ExceptionCode $code) {
        $this->code = $code->value;
    }

}