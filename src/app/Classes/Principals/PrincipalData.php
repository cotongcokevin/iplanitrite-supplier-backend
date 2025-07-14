<?php

declare(strict_types=1);

namespace App\Classes\Principals;

use App\Enums\AuthGuardType;
use Ramsey\Uuid\UuidInterface;

readonly class PrincipalData
{
    public function __construct(
        public UuidInterface $id,
        public string $firstName,
        public string $lastName,
        public AuthGuardType $type,
        public ?UuidInterface $guardId,
    ) {}
}
