<?php

declare(strict_types=1);

namespace App\Models\EventSegmentTemplate;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSegmentTemplateEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'event_segment_template';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventSegmentTemplateModel
    {
        return new EventSegmentTemplateModel(
            id: $this->id,
            eventType: $this->event_type,
            templateName: $this->template_name,
            isImmutable: $this->is_immutable,
            isRsvp: $this->is_rsvp,
            supplierId: $this->supplier_id,
            defaultNameLabel: $this->default_name_label,
            defaultLocationLabel: $this->default_location_label,
            defaultAddressLabel: $this->default_address_label,
            defaultNotesLabel: $this->default_notes_label,
            defaultDateFromLabel: $this->default_date_from_label,
            defaultDateToLabel: $this->default_date_to_label,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
