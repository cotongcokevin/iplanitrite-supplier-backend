<?php

declare(strict_types=1);

namespace App\Models\Country;

use App\Classes\Casts\UuidCast;
use App\Models\BaseEntity;

class CountryEntity extends BaseEntity
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'country';

    protected $casts = [
        'id' => UuidCast::class];

    public function toModel(): CountryModel
    {
        return new CountryModel(
            id: $this->id,
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
