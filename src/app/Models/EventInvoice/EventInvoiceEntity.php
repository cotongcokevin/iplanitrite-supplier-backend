<?php

declare(strict_types=1);

namespace App\Models\EventInvoice;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use App\Enums\EventInvoiceStatus;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventInvoiceEntity extends GuardedEntity
{  
    use SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'event_invoice';
    
    /**
     * @var string
     */
    protected $keyType = 'string';
    
    protected $casts = [
        'id' => UuidCast::class,
        'contact_number_id' => UuidCast::class,
        'address_id' => UuidCast::class,
        'client_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventInvoiceModel
    {
        return new EventInvoiceModel(
            id: $this->id,
            invoiceNumber: $this->invoice_number,
            name: $this->name,
            email: $this->email,
            contactNumberId: $this->contact_number_id,
            addressId: $this->address_id,
            status: EventInvoiceStatus::from($this->status),
            eventId: $this->event_id,
            clientId: $this->client_id,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
