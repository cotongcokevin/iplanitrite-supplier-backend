<?php

namespace Database\Seeders;

use Database\Seeders\Classes\AddressSeeder;
use Database\Seeders\Classes\AdminSeeder;
use Database\Seeders\Classes\ContactNumberSeeder;
use Database\Seeders\Classes\CountrySeeder;
use Database\Seeders\Classes\OrganizerPermissionSeeder;
use Database\Seeders\Classes\OrganizerRoleSeeder;
use Database\Seeders\Classes\OrganizerSeeder;
use Database\Seeders\Classes\OrganizerStaffSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            AddressSeeder::class,
            ContactNumberSeeder::class,

            // Admin
            AdminSeeder::class,

            // Organizers
            OrganizerSeeder::class,
            OrganizerRoleSeeder::class,
            OrganizerPermissionSeeder::class,
            OrganizerStaffSeeder::class,
        ]);
    }
}
