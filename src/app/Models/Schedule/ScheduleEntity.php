<?php

declare(strict_types=1);

namespace App\Models\Schedule;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'schedule';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'start_date' => CarbonCast::class,
        'end_date' => CarbonCast::class,
        'event_id' => UuidCast::class,
        'address_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): ScheduleModel
    {
        return new ScheduleModel(
            id: $this->id,
            title: $this->title,
            startDate: $this->start_date,
            endDate: $this->end_date,
            notes: $this->notes,
            isMandatory: $this->is_mandatory,
            eventId: $this->event_id,
            addressId: $this->address_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
