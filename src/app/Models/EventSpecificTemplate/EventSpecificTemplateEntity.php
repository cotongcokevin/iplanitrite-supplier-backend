<?php

declare(strict_types=1);

namespace App\Models\EventSpecificTemplate;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Data\Udf\UdfTemplate;
use Illuminate\Database\Eloquent\Model;

class EventSpecificTemplateEntity extends Model
{
    /**
     * @var string
     */
    protected $table = 'event_specific_template';

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
    ];

    public function toModel(): EventSpecificTemplateModel
    {
        return new EventSpecificTemplateModel(
            id: $this->id,
            eventType: $this->event_type,
            supplierId: $this->supplier_id,
            udf: UdfTemplate::fromString($this->udf),
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
