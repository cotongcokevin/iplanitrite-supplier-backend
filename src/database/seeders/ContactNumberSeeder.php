<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ContactNumber\ContactNumber;
use Illuminate\Database\Seeder;

class ContactNumberSeeder extends Seeder
{
    public const CONTACT_NUMBER_ONE_ID = '7126d5bf-1c8e-48db-94e7-afcd426529e6';

    public const CONTACT_NUMBER_TWO_ID = '52a5c5e2-835b-411f-a7e9-71c503d77cb1';

    public const CONTACT_NUMBER_THREE_ID = '3838c209-5eda-4bd6-aef3-dca9081d2bff';

    public const CONTACT_NUMBER_FOUR_ID = 'f598b48b-bd20-425a-a299-6f10a5f4bca7';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactNumber::create([
            'id' => self::CONTACT_NUMBER_ONE_ID,
            'phone_number' => '+61412345678',
        ]);

        ContactNumber::create([
            'id' => self::CONTACT_NUMBER_TWO_ID,
            'phone_number' => '+61498765432',
        ]);

        ContactNumber::create([
            'id' => self::CONTACT_NUMBER_THREE_ID,
            'phone_number' => '+639171234567',
        ]);

        ContactNumber::create([
            'id' => self::CONTACT_NUMBER_FOUR_ID,
            'phone_number' => '+639998765432',
        ]);

    }
}
