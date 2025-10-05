<?php

declare(strict_types=1);

namespace App\Models\ScheduleAppointee;

use App\Classes\Casts\UuidCast;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\Model;

class ScheduleAppointeeEntity extends GuardedEntity
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'schedule_appointee';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'schedule_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
    ];

    public function toModel(): ScheduleAppointeeModel
    {
        return new ScheduleAppointeeModel(
            id: $this->id,
            appointeeType: $this->appointee_type,
            appointeeId: $this->appointee_id,
            scheduleId: $this->event_id,
            supplierId: $this->supplier_id,
        );
    }
}
