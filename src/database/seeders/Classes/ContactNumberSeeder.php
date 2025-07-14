<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\ContactNumber\ContactNumberEntity;
use Illuminate\Database\Seeder;

class ContactNumberSeeder extends Seeder
{
    public const CONTACT_NUMBER_ONE_ID = '7126d5bf-1c8e-48db-94e7-afcd426529e6';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactNumberEntity::create([
            'id' => self::CONTACT_NUMBER_ONE_ID,
            'number' => '+639171234567',
            'country_id' => CountrySeeder::COUNTRY_ID_ONE,
        ]);
    }
}
