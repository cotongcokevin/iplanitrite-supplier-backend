<?php

declare(strict_types=1);

namespace App\Repositories\AdminRepository\Data;

class AdminRepositoryUpdateData
{

    /**
     * @param string $email
     * @param ?string $password
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(
        public string $email,
        public ?string $password,
        public string $firstName,
        public string $lastName,
    ) { }

}