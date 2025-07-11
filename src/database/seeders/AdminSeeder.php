<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public const ADMIN_ONE_ID = 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d';

    public const ADMIN_TWO_ID = '8dd17f21-524d-4ad9-8604-b7afe060fe3d';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        Admin::create([
            'id' => self::ADMIN_ONE_ID,
            'email' => 'naruto.uzumaki@ems.com',
            'password' => bcrypt('password'),
            'first_name' => 'Naruto',
            'last_name' => 'Uzumaki',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        Admin::create([
            'id' => self::ADMIN_TWO_ID,
            'email' => 'sasuke.uchiha@ems.com',
            'password' => bcrypt('password'),
            'first_name' => 'Sasuke',
            'last_name' => 'Uchiha',
            'created_at' => $date,
            'updated_at' => $date,
            'created_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
            'updated_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
        ]);
    }
}
