<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\Client\ClientEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ClientSeeder extends Seeder
{
    public const CLIENT_ID_ONE = '1effd70a-6b33-4715-9725-fc6ff1c8195b';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        ClientEntity::create([
            'id' => Uuid::fromString(self::CLIENT_ID_ONE),
            'email' => 'asta.staria@client.com',
            'password' => bcrypt('password'),
            'contact_number_id' => ContactNumberSeeder::CONTACT_NUMBER_TWO_ID,
            'first_name' => 'Asta',
            'last_name' => 'Staria',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
