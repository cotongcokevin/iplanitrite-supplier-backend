<?php

declare(strict_types=1);

namespace App\Models\Event;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventEntity extends Model
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
        'participant_one' => UuidCast::class,
        'participant_two' => UuidCast::class,
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
            status: $this->status,
            reasonForCancellation: $this->reason_for_cancellation,
            type: $this->type,
            participantOne: $this->participant_one,
            participantTwo: $this->participant_two,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
