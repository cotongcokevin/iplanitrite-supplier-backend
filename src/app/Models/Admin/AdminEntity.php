<?php

namespace App\Models\Admin;

use App\Classes\Principals\PrincipalData;
use App\Enums\AuthGuardType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AdminEntity extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected string $guard = 'admin';

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
    protected $table = 'admin';

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function toModel(): AdminModel
    {
        return new AdminModel(
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

    public function toPrincipalData(): PrincipalData
    {
        return new PrincipalData(
            id: Uuid::fromString($this->id),
            firstName: $this->first_name,
            lastName: $this->last_name,
            type: AuthGuardType::ADMIN,
            guardId: null
        );
    }
}
