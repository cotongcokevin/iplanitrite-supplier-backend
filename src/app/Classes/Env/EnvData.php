<?php

declare(strict_types=1);

namespace App\Classes\Env;

use App\Enums\EnvironmentType;

readonly class EnvData
{
    public function __construct(
        public EnvironmentType $environment,
        public string $adminFrontEndURI,
        public string $organizerFrontEndURI,
        public string $participantFrontEndURI,
    ) {}
}
