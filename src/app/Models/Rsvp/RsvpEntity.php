<?php

declare(strict_types=1);

namespace App\Models\Rsvp;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsvpEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'rsvp';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'schedule_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): RsvpModel
    {
        return new RsvpModel(
            id: $this->id,
            description: $this->description,
            guestsCount: $this->guests_count,
            scheduleId: $this->schedule_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
