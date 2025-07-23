<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

class NameRequestDto {

    public function __construct(
        public string $firstName,
        public string $lastName
    ) { }

}