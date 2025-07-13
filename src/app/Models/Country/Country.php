<?php

declare(strict_types=1);

namespace App\Models\Country;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Country extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'country';

    public function toModelData(): CountryData
    {
        return new CountryData(
            id: Uuid::fromString($this->id),
            name: $this->name,
            iso2Code: $this->iso2_code,
            iso3Code: $this->iso3_code,
            languageLocale: $this->language_locale,
            callingCode: $this->calling_code,
            flag: $this->flag,
            currencyCode: $this->currency_code,
            currencyName: $this->currency_name,
            currencySymbol: $this->currency_symbol,
        );
    }
}
