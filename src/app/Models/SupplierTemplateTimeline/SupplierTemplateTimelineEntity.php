<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateTimeline;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use App\Models\GuardedEntity;

class SupplierTemplateTimelineEntity extends GuardedEntity
{  
    
    /**
     * @var string
     */
    protected $table = 'supplier_template_timeline';
    
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

    public function toModel(): SupplierTemplateTimelineModel
    {
        return new SupplierTemplateTimelineModel(
            id: $this->id,
            name: $this->name,
            isRsvp: $this->is_rsvp,
            isMainEvent: $this->is_main_event,
            eventType: $this->event_type,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
