<?php

declare(strict_types=1);

namespace App\Models\Country;

use Illuminate\Database\Eloquent\Model;

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
