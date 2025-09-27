<?php

declare(strict_types=1);

namespace App\Models\Event;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventEntity extends GuardedEntity
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'event';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'client_id' => UuidCast::class,
        'celebrant_one' => UuidCast::class,
        'celebrant_two' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventModel
    {
        return new EventModel(
            id: $this->id,
            name: $this->name,
            status: EventStatus::from($this->status),
            type: EventType::from($this->type),
            notes: $this->notes,
            clientId: $this->client_id,
            celebrantOne: $this->celebrant_one,
            celebrantTwo: $this->celebrant_two,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
