<?php

declare(strict_types=1);

namespace App\Models\EventInvoiceItem;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventInvoiceItemEntity extends GuardedEntity
{  
    use SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'event_invoice_item';
    
    /**
     * @var string
     */
    protected $keyType = 'string';
    
    protected $casts = [
        'id' => UuidCast::class,
        'event_cost_id' => UuidCast::class,
        'event_invoice_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventInvoiceItemModel
    {
        return new EventInvoiceItemModel(
            id: $this->id,
            eventCostId: $this->event_cost_id,
            eventInvoiceId: $this->event_invoice_id,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
