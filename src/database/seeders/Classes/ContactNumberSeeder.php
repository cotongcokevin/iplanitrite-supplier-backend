<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\ContactNumber\ContactNumberEntity;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ContactNumberSeeder extends Seeder
{
    public const CONTACT_NUMBER_ONE_ID = '7126d5bf-1c8e-48db-94e7-afcd426529e6';

    public const CONTACT_NUMBER_TWO_ID = 'cdf1c0a6-7faa-45f2-a2c5-13cee2444966';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactNumberEntity::create([
            'id' => Uuid::fromString(self::CONTACT_NUMBER_ONE_ID),
            'number' => '+639171234567',
            'country_id' => Uuid::fromString(CountrySeeder::COUNTRY_ID_ONE),
        ]);

        ContactNumberEntity::create([
            'id' => Uuid::fromString(self::CONTACT_NUMBER_TWO_ID),
            'number' => '+639171234561',
            'country_id' => Uuid::fromString(CountrySeeder::COUNTRY_ID_ONE),
        ]);
    }
}
