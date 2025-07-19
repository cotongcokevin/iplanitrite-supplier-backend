<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\Country\CountryEntity;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CountrySeeder extends Seeder
{
    public const COUNTRY_ID_ONE = '5126d5bd-1c8e-48db-94e7-afcd426529e3';

    public const COUNTRY_ID_TWO = '9942040e-b66a-442e-b103-8865b2314a68';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CountryEntity::create([
            'id' => Uuid::fromString(self::COUNTRY_ID_ONE),
            'name' => 'Philippines',
            'iso2_code' => 'PH',
            'iso3_code' => 'PHL',
            'calling_code' => '63',
            'flag' => 'https://flagcdn.com/ph.svg',
            'language_locale' => 'en_PH',
            'currency_code' => 'PHP',
            'currency_name' => 'Philippine peso',
            'currency_symbol' => '₱',
        ]);

        CountryEntity::create([
            'id' => Uuid::fromString(self::COUNTRY_ID_TWO),
            'name' => 'Australia',
            'iso2_code' => 'AU',
            'iso3_code' => 'AUS',
            'calling_code' => '61',
            'flag' => 'https://flagcdn.com/au.svg',
            'language_locale' => 'en_AU',
            'currency_code' => 'AUD',
            'currency_name' => 'Australian dollar',
            'currency_symbol' => '$',
        ]);
    }
}
