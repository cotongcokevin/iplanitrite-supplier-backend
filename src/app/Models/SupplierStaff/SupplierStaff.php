<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff;

use App\Classes\Principals\PrincipalData;
use App\Classes\Scopes\Guard\GuardedAuthenticatedModel;
use App\Enums\AuthGuardType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SupplierStaff extends GuardedAuthenticatedModel implements JWTSubject
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
    protected $table = 'supplier_staff';

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function toModelData(): SupplierStaffModelData
    {
        return new SupplierStaffModelData(
            id: Uuid::fromString($this->id),
            email: $this->email,
            password: $this->password,
            firstName: $this->first_name,
            lastName: $this->last_name,
            dateOfBirth: $this->date_of_birth ? Carbon::parse($this->date_of_birth) : null,
            supplierId: Uuid::fromString($this->supplier_id),
            supplierRoleId: Uuid::fromString($this->supplier_role_id),
            contactNumberId: $this->contact_number_id ? Uuid::fromString($this->contact_number_id) : null,
            addressId: $this->address_id ? Uuid::fromString($this->address_id) : null,
            createdBy: $this->created_by ? Uuid::fromString($this->created_by) : null,
            updatedBy: $this->updated_by ? Uuid::fromString($this->updated_by) : null,
            createdAt: $this->createdAt ? Carbon::parse($this->created_at) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updated_at) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deleted_at) : null,
        );
    }

    public function toPrincipalData(): PrincipalData
    {
        return new PrincipalData(
            id: Uuid::fromString($this->id),
            firstName: $this->first_name,
            lastName: $this->last_name,
            type: AuthGuardType::SUPPLIER_STAFF,
            guardId: Uuid::fromString($this->supplier_id)
        );
    }
}
