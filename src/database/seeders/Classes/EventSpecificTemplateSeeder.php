<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Data\Udf\UdfTemplate;
use App\Enums\EventType;
use App\Enums\UserDefinedFieldType;
use App\Models\EventSpecificTemplate\EventSpecificTemplateEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSpecificTemplateSeeder extends Seeder
{
    public const EVENT_SPECIFIC_TEMPLATE_ONE_ID = '3b1000fd-fe7a-49ec-9728-87c471a311ee';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        EventSpecificTemplateEntity::create([
            'id' => self::EVENT_SPECIFIC_TEMPLATE_ONE_ID,
            'event_type' => EventType::WEDDING,
            'supplier_id' => SupplierSeeder::SUPPLIER_ONE_ID,
            'udf' => json_encode([
                new UdfTemplate(
                    name: 'Number of Guests',
                    type: UserDefinedFieldType::NUMBER,
                    required: false
                ),
                new UdfTemplate(
                    name: 'Number of Guests',
                    type: UserDefinedFieldType::COLOR_PALETTE,
                    required: false
                ),
            ]),
            'created_by' => AdminSeeder::ADMIN_TWO_ID,
            'updated_by' => AdminSeeder::ADMIN_TWO_ID,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
