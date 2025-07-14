<?php

declare(strict_types=1);

namespace App\Models\Country;

use App\Dto\Response\CountryDto;
use Ramsey\Uuid\UuidInterface;

class CountryModel
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

    public function toDto(): CountryDto
    {
        return new CountryDto(
            id: $this->id,
            name: $this->name,
            iso2Code: $this->iso2Code,
            iso3Code: $this->iso3Code,
            languageLocale: $this->languageLocale,
            callingCode: $this->callingCode,
            flag: $this->flag,
            currencyCode: $this->currencyCode,
            currencyName: $this->currencyName,
            currencySymbol: $this->currencySymbol,
        );
    }
}
