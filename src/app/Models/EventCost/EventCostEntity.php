<?php

declare(strict_types=1);

namespace App\Models\EventCost;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCostEntity extends GuardedEntity
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'event_cost';

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
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventCostModel
    {
        return new EventCostModel(
            id: $this->id,
            name: $this->name,
            amount: $this->amount,
            eventId: $this->event_id,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
