<?php

declare(strict_types=1);

namespace App\Models\Organizer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Organizer extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected string $guard = 'organizer';

    /**
     * $keyType is the type of the id of the table which is UUID
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Increment is false as we're using UUID
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'organizer';

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

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
