<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\Country\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public const COUNTRY_ID_ONE = '5126d5bd-1c8e-48db-94e7-afcd426529e3';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'id' => self::COUNTRY_ID_ONE,
            'name' => 'Philippines',
            'iso2_code' => 'PH',
            'iso3_code' => 'PHL',
            'calling_code' => '63',
            'flag' => 'https://restcountries.com/data/phl.svg',
            'language_locale' => 'en_PH',
            'currency_code' => 'PHP',
            'currency_name' => 'Philippine peso',
            'currency_symbol' => '₱',
        ]);
    }
}
