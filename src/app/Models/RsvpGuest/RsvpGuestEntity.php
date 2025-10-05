<?php

declare(strict_types=1);

namespace App\Models\RsvpGuest;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Models\GuardedEntity;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsvpGuestEntity extends GuardedEntity
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'rsvp_guest';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'rsvp_id' => UuidCast::class,
        'rsvp_guest_group_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): RsvpGuestModel
    {
        return new RsvpGuestModel(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            email: $this->email,
            status: $this->status,
            rsvpId: $this->rsvp_id,
            rsvpGuestGroupId: $this->rsvp_guest_group_id,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
