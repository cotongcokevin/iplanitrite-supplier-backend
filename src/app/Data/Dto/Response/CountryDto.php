<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use Ramsey\Uuid\UuidInterface;

class CountryDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public string $iso2Code,
        public string $iso3Code,
        public string $languageLocale,
        public string $callingCode,
        public string $flag,
        public string $currencyCode,
        public string $currencyName,
        public string $currencySymbol,
    ) {}
}
