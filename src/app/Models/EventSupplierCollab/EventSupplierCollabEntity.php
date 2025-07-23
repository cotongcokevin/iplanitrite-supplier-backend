<?php

declare(strict_types=1);

namespace App\Models\EventSupplierCollab;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use Illuminate\Database\Eloquent\Model;

class EventSupplierCollabEntity extends Model
{  
    
    /**
     * @var string
     */
    protected $table = 'event_supplier_collab';
    
    /**
     * @var string
     */
    protected $keyType = 'string';
    
    protected $casts = [
        'id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'supplier_partner_id' => UuidCast::class,
        'event_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): EventSupplierCollabModel
    {
        return new EventSupplierCollabModel(
            id: $this->id,
            status: $this->status,
            supplierId: $this->supplier_id,
            supplierPartnerId: $this->supplier_partner_id,
            eventId: $this->event_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
