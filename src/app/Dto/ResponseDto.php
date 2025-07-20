<?php

declare(strict_types=1);

namespace App\Dto;

use JsonSerializable;

abstract class ResponseDto implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        $data = get_object_vars($this);

        if (array_key_exists('context', $data) && $data['context'] === null) {
            unset($data['context']);
        }

        return $data;
    }
}
