<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\SupplierStaff\SupplierStaffEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SupplierStaffSeeder extends Seeder
{
    public const SUPPLIER_STAFF_ONE_ID = '781479fe-1d65-418a-bc4f-8317452d8452';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();
        $dateOfBirth = Carbon::parse('2005-01-01')->toDateString();

        SupplierStaffEntity::create([
            'id' => Uuid::fromString(self::SUPPLIER_STAFF_ONE_ID),
            'email' => 'luffy.monkey@ems.com',
            'password' => bcrypt('password'),
            'first_name' => 'Luffy',
            'last_name' => 'Monkey',
            'date_of_birth' => $dateOfBirth,
            'supplier_id' => Uuid::fromString(SupplierSeeder::SUPPLIER_ONE_ID),
            'supplier_role_id' => Uuid::fromString(SupplierRoleSeeder::SUPPLIER_ROLE_ONE_ID),
            'address_id' => Uuid::fromString(AddressSeeder::ADDRESS_ONE_ID),
            'contact_number_id' => Uuid::fromString(ContactNumberSeeder::CONTACT_NUMBER_ONE_ID),
            'created_by' => null,
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
