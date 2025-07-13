<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SupplierStaff extends Authenticatable implements JWTSubject
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

    public function toModelData(): SupplierStaffData
    {
        return new SupplierStaffData(
            id: Uuid::fromString($this->id),
            email: $this->email,
            password: $this->password,
            firstName: $this->firstName,
            lastName: $this->lastName,
            dateOfBirth: $this->dateOfBirth ? Carbon::parse($this->dateOfBirth) : null,
            supplierId: $this->supplierId,
            supplierRoleId: $this->supplierRoleId,
            contactNumberId: $this->contactNumberId,
            addressId: $this->addressId,
            createdBy: $this->created_by ? Uuid::fromString($this->created_by) : null,
            updatedBy: $this->updated_by ? Uuid::fromString($this->updated_by) : null,
            createdAt: $this->createdAt ? Carbon::parse($this->created_at) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updated_at) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deleted_at) : null,
        );
    }
}
