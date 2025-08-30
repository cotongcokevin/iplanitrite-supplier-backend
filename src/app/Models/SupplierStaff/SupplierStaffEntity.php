<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Classes\Principals\PrincipalData;
use App\Classes\Scopes\Guard\GuardedAuthenticatedEntity;
use App\Models\Address\AddressEntity;
use App\Models\ContactNumber\ContactNumberEntity;
use App\Models\SupplierStaff\Context\SupplierStaffContext;
use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Models\SupplierStaff\Context\SupplierStaffContextType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\UuidInterface;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SupplierStaffEntity extends GuardedAuthenticatedEntity implements JWTSubject
{
    use SoftDeletes;

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

    protected $casts = [
        'id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'supplier_role_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'contact_number_id' => UuidCast::class,
        'address_id' => UuidCast::class,
        'date_of_birth' => CarbonCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function getJWTIdentifier(): UuidInterface
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(AddressEntity::class, 'address_id');
    }

    public function contactNumber(): BelongsTo
    {
        return $this->belongsTo(ContactNumberEntity::class, 'contact_number_id');
    }

    public function toModel(): SupplierStaffModel
    {
        return new SupplierStaffModel(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->first_name,
            lastName: $this->last_name,
            dateOfBirth: $this->date_of_birth ? $this->date_of_birth : null,
            supplierId: $this->supplier_id,
            supplierRoleId: $this->supplier_role_id,
            contactNumberId: $this->contact_number_id ? $this->contact_number_id : null,
            addressId: $this->address_id ? $this->address_id : null,
            createdBy: $this->created_by ? $this->created_by : null,
            updatedBy: $this->updated_by ? $this->updated_by : null,
            createdAt: $this->createdAt ? $this->created_at : null,
            updatedAt: $this->updatedAt ? $this->updated_at : null,
            deletedAt: $this->deletedAt ? $this->deleted_at : null,
        );
    }

    /**
     * @return SupplierStaffContext
     */
    public function buildContext(): SupplierStaffContext
    {
        $addressModel = $this->relationLoaded(SupplierStaffContextType::ADDRESS->value)
            ? $this->address?->toModel()
            : null;

        $contactNumberModel = $this->relationLoaded(SupplierStaffContextType::CONTACT_NUMBER->value)
            ? $this->contactNumber?->toModel()
            : null;

        return new SupplierStaffContext(
            address: $addressModel,
            contactNumber: $contactNumberModel,
        );
    }

    public function toPrincipalData(): PrincipalData
    {
        return new PrincipalData(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            guardId: $this->supplier_id
        );
    }
}
