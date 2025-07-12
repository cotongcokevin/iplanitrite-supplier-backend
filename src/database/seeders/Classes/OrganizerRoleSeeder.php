<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\OrganizerRole\OrganizerRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizerRoleSeeder extends Seeder
{
    public const ORGANIZER_ROLE_ONE_ID = 'c4d86258-54fb-42f4-880e-3e5eae34619c';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        OrganizerRole::create([
            'id' => self::ORGANIZER_ROLE_ONE_ID,
            'name' => 'Administrator',
            'immutable' => true,
            'organizer_id' => OrganizerSeeder::ORGANIZER_ONE_ID,
            'created_by' => null, // initially we don't have staff that will create the roles yet when we have a new org
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
