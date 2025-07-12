<?php

declare(strict_types=1);

namespace App\Models\Organizer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizer extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'organizer';

    public function toModelData(): OrganizerData
    {
        return new OrganizerData(
            id: $this->id,
            name: $this->name,
            description: $this->description,
            maxStaff: $this->maxStaff,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deletedAt) : null,
        );
    }
}
