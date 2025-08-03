<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Enums\SubscriptionTier;
use App\Models\Supplier\SupplierEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SupplierSeeder extends Seeder
{
    public const SUPPLIER_ONE_ID = '01a1da32-8149-4a93-8270-37d77e447de7';

    public const SUPPLIER_TWO_ID = '0ee5647d-0b57-4321-95eb-a980d0c77456';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        SupplierEntity::create([
            'id' => Uuid::fromString(self::SUPPLIER_ONE_ID),
            'name' => 'One Piece',
            'subscription_tier' => SubscriptionTier::STANDARD,
            'created_by' => Uuid::fromString(AdminSeeder::ADMIN_ONE_ID),
            'updated_by' => Uuid::fromString(AdminSeeder::ADMIN_ONE_ID),
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        SupplierEntity::create([
            'id' => Uuid::fromString(self::SUPPLIER_TWO_ID),
            'name' => 'Solo Leveling',
            'subscription_tier' => SubscriptionTier::BASIC,
            'created_by' => Uuid::fromString(AdminSeeder::ADMIN_ONE_ID),
            'updated_by' => Uuid::fromString(AdminSeeder::ADMIN_ONE_ID),
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
