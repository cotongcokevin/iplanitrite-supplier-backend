<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Enums\OrganizerPermissionType;
use App\Models\OrganizerPermission\OrganizerPermission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizerPermissionSeeder extends Seeder
{
    public const ORGANIZER_PERMISSION_ONE_ID = 'cd420410-0c28-4c66-863d-f94730c9f5aa';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        OrganizerPermission::create([
            'id' => self::ORGANIZER_PERMISSION_ONE_ID,
            'name' => OrganizerPermissionType::EVENTS,
            'organizer_role_id' => OrganizerRoleSeeder::ORGANIZER_ROLE_ONE_ID,
            'created_by' => null,
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
