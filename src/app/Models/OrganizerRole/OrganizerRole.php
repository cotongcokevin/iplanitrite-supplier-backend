<?php

declare(strict_types=1);

namespace App\Models\OrganizerRole;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrganizerRole extends Model
{
    
    /**
     * @var string 
     */
    protected $table = 'organizer_role';
    
    public function toModelData(): OrganizerRoleData
    {
        return new OrganizerRoleData(
            id: $this->id,
            name: $this->name,
            immutable: $this->immutable,
            organizerId: $this->organizerId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
        );
    }

}
