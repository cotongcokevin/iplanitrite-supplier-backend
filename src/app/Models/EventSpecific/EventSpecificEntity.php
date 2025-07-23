<?php

declare(strict_types=1);

namespace App\Models\EventSpecific;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use Illuminate\Database\Eloquent\Model;

class EventSpecificEntity extends Model
{  
    
    /**
     * @var string
     */
    protected $table = 'event_specific';
    
    /**
     * @var string
     */
    protected $keyType = 'string';
    
    protected $casts = [
        'id' => UuidCast::class,
        'event_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): EventSpecificModel
    {
        return new EventSpecificModel(
            id: $this->id,
            eventId: $this->event_id,
            udf: $this->udf,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
