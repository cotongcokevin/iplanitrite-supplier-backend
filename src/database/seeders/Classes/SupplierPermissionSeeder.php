<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Enums\SupplierPermissionType;
use App\Models\SupplierPermission\SupplierPermission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SupplierPermissionSeeder extends Seeder
{
    public const SUPPLIER_PERMISSION_ONE_ID = 'cd420410-0c28-4c66-863d-f94730c9f5aa';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        SupplierPermission::create([
            'id' => self::SUPPLIER_PERMISSION_ONE_ID,
            'name' => SupplierPermissionType::EVENTS,
            'supplier_role_id' => SupplierRoleSeeder::SUPPLIER_ROLE_ONE_ID,
            'created_by' => null,
            'updated_by' => null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

    }
}
