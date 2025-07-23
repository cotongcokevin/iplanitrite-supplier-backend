<?php

declare(strict_types=1);

namespace App\Models\EventSegment;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSegmentEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'event_segment';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'address_id' => UuidCast::class,
        'date_from' => CarbonCast::class,
        'date_to' => CarbonCast::class,
        'event_segment_template_id' => UuidCast::class,
        'event_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventSegmentModel
    {
        return new EventSegmentModel(
            id: $this->id,
            name: $this->name,
            locationLabel: $this->location_label,
            location: $this->location,
            addressLabel: $this->address_label,
            addressId: $this->address_id,
            notesLabel: $this->notes_label,
            notes: $this->notes,
            dateFromLabel: $this->date_from_label,
            dateFrom: $this->date_from,
            dateToLabel: $this->date_to_label,
            dateTo: $this->date_to,
            udf: $this->udf,
            eventSegmentTemplateId: $this->event_segment_template_id,
            eventId: $this->event_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
