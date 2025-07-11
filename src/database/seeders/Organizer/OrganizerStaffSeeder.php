<?php

declare(strict_types=1);

namespace Database\Seeders\Organizer;

use App\Models\OrganizerStaff\OrganizerStaff;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizerStaffSeeder extends Seeder
{
    public const ORGANIZER_STAFF_ONE_ID = '781479fe-1d65-418a-bc4f-8317452d8452';

    public const ORGANIZER_STAFF_TWO_ID = '264ac8aa-2728-473a-89d7-e5770c80dd61';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->toDateTimeString();

        OrganizerStaff::create([
            'id' => self::ORGANIZER_STAFF_ONE_ID,
            'email' => 'staff+01@ems.com',
            'password' => 'password',
            'first_name' => 'Org Staff',
            'last_name' => 'One',
            'date_of_birth' => '1993-01-01', // YYYY-MM-DD
            'organizer_id' => OrganizerSeeder::ORGANIZER_ONE_ID,
            'organizer_role_id' => OrganizerRoleSeeder::ORGANIZER_ROLE_ONE_ID,
            'created_by' => null, // initial stuff usually are created by super admin
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
