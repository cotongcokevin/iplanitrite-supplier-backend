<?php

declare(strict_types=1);

namespace App\Models\EventSegmentTemplateCustomField;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;

class EventSegmentTemplateCustomFieldEntity extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'event_segment_template_custom_field';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'event_segment_id' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): EventSegmentTemplateCustomFieldModel
    {
        return new EventSegmentTemplateCustomFieldModel(
            id: $this->id,
            name: $this->name,
            type: $this->type,
            required: $this->required,
            eventSegmentId: $this->event_segment_id,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
