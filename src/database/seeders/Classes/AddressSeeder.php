<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\Address\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public const ADDRESS_ONE_ID = '9536d5bf-1c8e-48db-94e7-bcfd426529a9';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'id' => self::ADDRESS_ONE_ID,
            'line_1' => 'Eulogio Amang Rodriguez Ave',
            'line_2' => null,
            'city' => 'Pasig',
            'state' => 'Metro Manila',
            'zip' => '1800',
            'lat' => null,
            'long' => null,
        ]);
    }
}
