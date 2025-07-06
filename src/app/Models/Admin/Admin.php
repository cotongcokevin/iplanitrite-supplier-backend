<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{

    use SoftDeletes;

    /**
     * $keyType is the type of the id of the table which is UUID
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Increment is false as we're using UUID
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'admin';

    /**
     * @return string
     */
    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @return AdminEntity
     */
    public function toEntity(): AdminEntity {
        return new AdminEntity(
            id: Uuid::fromString($this->id),
            email: $this->email,
            password: $this->password,
            firstName: $this->first_name,
            lastName: $this->last_name,
            createdBy: $this->created_by ? Uuid::fromString($this->created_by) : null,
            updatedBy: $this->updated_by ? Uuid::fromString($this->updated_by) : null,
            createdAt: Carbon::parse($this->created_at),
            updatedAt: Carbon::parse($this->updated_at),
            deletedAt: $this->deleted_at ? Carbon::parse($this->deleted_at) : null,
        );
    }

}
