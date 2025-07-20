<?php

namespace App\Models\Admin;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Classes\Principals\PrincipalData;
use App\Enums\AuthGuardType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AdminEntity extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected string $guard = 'ADMIN';

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

    protected $casts = [
        'id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

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
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->first_name,
            lastName: $this->last_name,
            createdBy: $this->created_by ? $this->created_by : null,
            updatedBy: $this->updated_by ? $this->updated_by : null,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at ? $this->deleted_at : null,
        );
    }

    public function toPrincipalData(): PrincipalData
    {
        return new PrincipalData(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            type: AuthGuardType::ADMIN,
            guardId: null
        );
    }
}
