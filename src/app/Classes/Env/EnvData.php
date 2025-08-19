<?php

declare(strict_types=1);

namespace App\Classes\Env;

use App\Enums\EnvironmentType;
use Ramsey\Uuid\UuidInterface;

readonly class EnvData
{
    public function __construct(
        public EnvironmentType $environment,
        public string $adminFrontEndURI,
        public UuidInterface $countryId,
        public string $jwtTokenName,
        public int $jwtTTL
    ) {}
}
