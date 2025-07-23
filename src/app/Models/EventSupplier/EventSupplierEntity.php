<?php

declare(strict_types=1);

namespace App\Models\EventSupplier;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;

class EventSupplierEntity extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'event_supplier';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'event_id' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): EventSupplierModel
    {
        return new EventSupplierModel(
            id: $this->id,
            name: $this->name,
            status: $this->status,
            reasonForCancellation: $this->reason_for_cancellation,
            supplierId: $this->supplier_id,
            eventId: $this->event_id,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
