<?php

declare(strict_types=1);

namespace Database\Seeders\Classes;

use App\Enums\EventSegmentTemplateCustomFieldType;
use App\Enums\EventType;
use App\Models\EventSegmentTemplate\EventSegmentTemplateEntity;
use App\Models\EventSegmentTemplateCustomField\EventSegmentTemplateCustomFieldEntity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSegmentTemplateSeeder extends Seeder
{
    public const EVENT_SEGMENT_TEMPLATE_ID_ONE = '5e6895e5-7385-47e6-a054-83cb38d05878';

    public const EVENT_SEGMENT_TEMPLATE_CUSTOM_FIELD_ID_ONE = '3dede20e-b5a9-4a86-9674-2061cca7b32f';

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
            'is_immutable' => false,
            'is_rsvp' => false,
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

        EventSegmentTemplateCustomFieldEntity::create([
            'id' => self::EVENT_SEGMENT_TEMPLATE_CUSTOM_FIELD_ID_ONE,
            'name' => 'Main Topic',
            'type' => EventSegmentTemplateCustomFieldType::TEXTBOX,
            'required' => true,
            'event_segment_id' => self::EVENT_SEGMENT_TEMPLATE_ID_ONE,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        EventSegmentTemplateCustomFieldEntity::create([
            'id' => self::EVENT_SEGMENT_TEMPLATE_CUSTOM_FIELD_ID_ONE,
            'name' => 'Sure Lead',
            'type' => EventSegmentTemplateCustomFieldType::CHECKBOX,
            'required' => true,
            'event_segment_id' => self::EVENT_SEGMENT_TEMPLATE_ID_ONE,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        EventSegmentTemplateEntity::create([
            'id' => self::EVENT_SEGMENT_TEMPLATE_ID_ONE,
            'event_type' => EventType::WEDDING,
            'template_name' => 'Wedding',
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
            'id' => self::EVENT_SEGMENT_TEMPLATE_ID_ONE,
            'event_type' => EventType::WEDDING,
            'template_name' => 'Reception',
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
