<?php

namespace Database\Seeders;

use Database\Seeders\Organizer\OrganizerPermissionSeeder;
use Database\Seeders\Organizer\OrganizerRoleSeeder;
use Database\Seeders\Organizer\OrganizerSeeder;
use Database\Seeders\Organizer\OrganizerStaffSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            OrganizerSeeder::class,
            ContactNumberSeeder::class,
            OrganizerRoleSeeder::class,
            OrganizerStaffSeeder::class,
            OrganizerPermissionSeeder::class,
        ]);
    }
}
