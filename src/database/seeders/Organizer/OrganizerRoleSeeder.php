<?php

declare(strict_types=1);

namespace Database\Seeders\Organizer;

use App\Models\OrganizerRole\OrganizerRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizerRoleSeeder extends Seeder
{
    public const ORGANIZER_ROLE_ONE_ID = 'c4d86258-54fb-42f4-880e-3e5eae34619c';

    public const ORGANIZER_ROLE_TWO_ID = '6b2deff5-a8c9-4097-92d2-eaa0eac0f8dc';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->toDateTimeString();
        OrganizerRole::create([
            'id' => self::ORGANIZER_ROLE_ONE_ID,
            'name' => 'Org Admin',
            'immutable' => true,
            'organizer_id' => OrganizerSeeder::ORGANIZER_ONE_ID,
            'created_by' => null, // initially we don't have staff that will create the roles yet when we have a new org
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
