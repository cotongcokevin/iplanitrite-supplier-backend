<?php

declare(strict_types=1);

namespace App\Models\EventSupplierCollabSegment;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use Illuminate\Database\Eloquent\Model;

class EventSupplierCollabSegmentEntity extends Model
{ 
    public $timestamps = false; 
    
    /**
     * @var string
     */
    protected $table = 'event_supplier_collab_segment';
    
    /**
     * @var string
     */
    protected $keyType = 'string';
    
    protected $casts = [
        'id' => UuidCast::class,
        'event_supplier_collab_id' => UuidCast::class,
        'event_segment_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): EventSupplierCollabSegmentModel
    {
        return new EventSupplierCollabSegmentModel(
            id: $this->id,
            eventSupplierCollabId: $this->event_supplier_collab_id,
            eventSegmentId: $this->event_segment_id,
            supplierId: $this->supplier_id,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
