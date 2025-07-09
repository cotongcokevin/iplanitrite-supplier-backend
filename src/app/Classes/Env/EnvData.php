<?php

declare(strict_types=1);

namespace App\Classes\Env;

readonly class EnvData
{
    public function __construct(
        public string $adminFrontEndURI,
        public string $organizerFrontEndURI,
        public string $participantFrontEndURI,
    ) {}
}
