<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\Admin\AdminEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AdminSeeder extends Seeder
{
    public const ADMIN_ONE_ID = 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d';

    public const ADMIN_TWO_ID = '8dd17f21-524d-4ad9-8604-b7afe060fe3d';

    public const ADMIN_THREE_ID = '01c319d6-99c0-4533-929f-80e694756034';

    public const ADMIN_FOUR_ID = 'b497dcd8-d84c-409b-90ec-24ec70530f2e';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        AdminEntity::create([
            'id' => Uuid::fromString(self::ADMIN_ONE_ID),
            'email' => 'kevin@iplanitrite.com',
            'password' => bcrypt('password'),
            'first_name' => 'Kevin',
            'last_name' => 'Cotongco',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        AdminEntity::create([
            'id' => Uuid::fromString(self::ADMIN_TWO_ID),
            'email' => 'andrew@iplanitrite.com',
            'password' => bcrypt('password'),
            'first_name' => 'Andrew',
            'last_name' => 'Llorera',
            'created_at' => $date,
            'updated_at' => $date,
            'created_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
            'updated_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
        ]);

        AdminEntity::create([
            'id' => Uuid::fromString(self::ADMIN_THREE_ID),
            'email' => 'ellaine@iplanitrite.com',
            'password' => bcrypt('password'),
            'first_name' => 'Ellaine',
            'last_name' => 'Almira',
            'created_at' => $date,
            'updated_at' => $date,
            'created_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
            'updated_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
        ]);

        AdminEntity::create([
            'id' => Uuid::fromString(self::ADMIN_FOUR_ID),
            'email' => 'jace@iplanitrite.com',
            'password' => bcrypt('password'),
            'first_name' => 'Joy',
            'last_name' => 'Basa',
            'created_at' => $date,
            'updated_at' => $date,
            'created_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
            'updated_by' => 'd611fad5-e65e-4afb-a201-bc3dad9f1e7d',
        ]);
    }
}
