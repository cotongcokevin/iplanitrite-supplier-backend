<?php

declare(strict_types=1);

namespace App\Models\OrganizerStaff;

use Illuminate\Database\Eloquent\Model;

class OrganizerStaff extends Model
{
    /**
     * @var string
     */
    protected $table = 'organizer_staff';

    public function toModelData(): OrganizerStaffData
    {
        return new OrganizerStaffData;
    }
}
