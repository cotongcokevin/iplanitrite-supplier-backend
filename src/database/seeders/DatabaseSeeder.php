<?php

namespace Database\Seeders;

use Database\Seeders\Classes\AddressSeeder;
use Database\Seeders\Classes\AdminSeeder;
use Database\Seeders\Classes\ContactNumberSeeder;
use Database\Seeders\Classes\CountrySeeder;
use Database\Seeders\Classes\SupplierPermissionSeeder;
use Database\Seeders\Classes\SupplierRoleSeeder;
use Database\Seeders\Classes\SupplierSeeder;
use Database\Seeders\Classes\SupplierStaffSeeder;
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

            // Suppliers
            SupplierSeeder::class,
            SupplierRoleSeeder::class,
            SupplierPermissionSeeder::class,
            SupplierStaffSeeder::class,
        ]);
    }
}
