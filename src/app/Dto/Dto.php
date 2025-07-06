<?php

namespace App\Dto;

class Dto
{
    public function toArray(): array
    {
        return json_decode(
            json_encode($this),
            true
        );
    }
}
