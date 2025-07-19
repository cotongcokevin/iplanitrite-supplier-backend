<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Models\SupplierRole\SupplierRoleEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SupplierRoleSeeder extends Seeder
{
    public const SUPPLIER_ROLE_ONE_ID = 'c4d86258-54fb-42f4-880e-3e5eae34619c';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        SupplierRoleEntity::create([
            'id' => Uuid::fromString(self::SUPPLIER_ROLE_ONE_ID),
            'name' => 'Administrator',
            'immutable' => true,
            'supplier_id' => Uuid::fromString(SupplierSeeder::SUPPLIER_ONE_ID),
            'created_by' => null, // initially we don't have staff that will create the roles yet when we have a new org
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
