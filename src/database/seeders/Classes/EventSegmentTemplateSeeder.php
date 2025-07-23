<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Data\Udf\UdfTemplate;
use App\Enums\EventType;
use App\Enums\UserDefinedFieldType;
use App\Models\EventSegmentTemplate\EventSegmentTemplateEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSegmentTemplateSeeder extends Seeder
{
    public const EVENT_SEGMENT_TEMPLATE_ID_ONE = '5e6895e5-7385-47e6-a054-83cb38d05878';

    public const EVENT_SEGMENT_TEMPLATE_ID_TWO = '4e6895e5-7385-47e6-a054-83cb38d05871';

    public const EVENT_SEGMENT_TEMPLATE_ID_THREE = 'e16895e5-7385-47e6-a054-83cb38d05811';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::parse('2025-01-01 00:00:00')->toDateTimeString();

        EventSegmentTemplateEntity::create([
            'id' => self::EVENT_SEGMENT_TEMPLATE_ID_ONE,
            'event_type' => EventType::WEDDING,
            'template_name' => 'Meeting',
            'on_field' => true,
            'is_immutable' => false,
            'is_rsvp' => false,
            'udf' => json_encode([
                new UdfTemplate(
                    name: 'Extra Notes',
                    type: UserDefinedFieldType::TEXTAREA,
                    required: false
                ),
            ]),
            'supplier_id' => SupplierSeeder::SUPPLIER_ONE_ID,
            'default_location_label' => 'Meetup Location',
            'default_address_label' => 'Meetup Address',
            'default_notes_label' => 'Meetup Notes',
            'default_date_from_label' => 'Date & Time',
            'default_date_to_label' => 'Date & Time',
            'created_by' => AdminSeeder::ADMIN_TWO_ID,
            'updated_by' => AdminSeeder::ADMIN_TWO_ID,
            'created_at' => $date,
            'updated_at' => $date,
            'deleted_at' => $date,
        ]);

        EventSegmentTemplateEntity::create([
            'id' => self::EVENT_SEGMENT_TEMPLATE_ID_TWO,
            'event_type' => EventType::WEDDING,
            'template_name' => 'Wedding',
            'on_field' => true,
            'is_immutable' => true,
            'is_rsvp' => true,
            'supplier_id' => SupplierSeeder::SUPPLIER_ONE_ID,
            'default_location_label' => null,
            'default_address_label' => null,
            'default_notes_label' => null,
            'default_date_from_label' => null,
            'default_date_to_label' => null,
            'created_by' => AdminSeeder::ADMIN_TWO_ID,
            'updated_by' => AdminSeeder::ADMIN_TWO_ID,
            'created_at' => $date,
            'updated_at' => $date,
            'deleted_at' => $date,
        ]);

        EventSegmentTemplateEntity::create([
            'id' => self::EVENT_SEGMENT_TEMPLATE_ID_THREE,
            'event_type' => EventType::WEDDING,
            'template_name' => 'Reception',
            'on_field' => true,
            'is_immutable' => true,
            'is_rsvp' => true,
            'supplier_id' => SupplierSeeder::SUPPLIER_ONE_ID,
            'default_location_label' => null,
            'default_address_label' => null,
            'default_notes_label' => null,
            'default_date_from_label' => null,
            'default_date_to_label' => null,
            'created_by' => AdminSeeder::ADMIN_TWO_ID,
            'updated_by' => AdminSeeder::ADMIN_TWO_ID,
            'created_at' => $date,
            'updated_at' => $date,
            'deleted_at' => $date,
        ]);
    }
}
