<?php

declare(strict_types=1);

namespace App\Models\RsvpGuestGroup;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsvpGuestGroupEntity extends GuardedEntity
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'rsvp_guest_group';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'rsvp_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): RsvpGuestGroupModel
    {
        return new RsvpGuestGroupModel(
            id: $this->id,
            name: $this->name,
            rsvpId: $this->rsvp_id,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
