<?php

declare(strict_types=1);

namespace App\Repositories\AdminRepository\Data;

class AdminRepositoryUpdateData
{
    public function __construct(
        public string $email,
        public ?string $password,
        public string $firstName,
        public string $lastName,
    ) {}
}
