<?php

declare(strict_types=1);

namespace App\Models\OrganizerPermission;

use App\Enums\OrganizerPermissionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrganizerPermission extends Model
{
    /**
     * @var string
     */
    protected $table = 'organizer_permission';

    public function toModelData(): OrganizerPermissionData
    {
        return new OrganizerPermissionData(
            id: $this->id,
            name: OrganizerPermissionType::from($this->name),
            organizerRoleId: $this->organizerRoleId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
        );
    }
}
