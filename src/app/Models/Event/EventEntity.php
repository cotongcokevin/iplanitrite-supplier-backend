<?php

declare(strict_types=1);

namespace App\Models\Event;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventEntity extends Model
{
    public $timestamps = false;

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
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): EventModel
    {
        return new EventModel(
            id: $this->id,
            status: $this->status,
            name: $this->name,
            type: $this->type,
            clientId: $this->client_id,
            celebrantOne: $this->celebrant_one,
            celebrantTwo: $this->celebrant_two,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
