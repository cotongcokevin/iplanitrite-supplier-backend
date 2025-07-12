<?php

declare(strict_types=1);

namespace App\Models\OrganizerStaff;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizerStaff extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'organizer_staff';

    public function toModelData(): OrganizerStaffData
    {
        return new OrganizerStaffData(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->firstName,
            lastName: $this->lastName,
            dateOfBirth: $this->dateOfBirth ? Carbon::parse($this->dateOfBirth) : null,
            organizerId: $this->organizerId,
            organizerRoleId: $this->organizerRoleId,
            contactNumberId: $this->contactNumberId,
            addressId: $this->addressId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deletedAt) : null,
        );
    }
}
