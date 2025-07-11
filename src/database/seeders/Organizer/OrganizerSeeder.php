<?php

declare(strict_types=1);

namespace Database\Seeders\Organizer;

use App\Models\Organizer\Organizer;
use Carbon\Carbon;
use Database\Seeders\AdminSeeder;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    public const ORGANIZER_ONE_ID = '01a1da32-8149-4a93-8270-37d77e447de7';

    public const ORGANIZER_TWO_ID = '0ee5647d-0b57-4321-95eb-a980d0c77456';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->toDateTimeString();

        Organizer::create([
            'id' => self::ORGANIZER_ONE_ID,
            'name' => 'One Piece',
            'max_staff' => 10,
            'created_by' => AdminSeeder::ADMIN_ONE_ID,
            'updated_by' => AdminSeeder::ADMIN_ONE_ID,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        Organizer::create([
            'id' => self::ORGANIZER_TWO_ID,
            'name' => 'Solo Leveling',
            'max_staff' => '1',
            'created_by' => AdminSeeder::ADMIN_ONE_ID,
            'updated_by' => AdminSeeder::ADMIN_ONE_ID,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
