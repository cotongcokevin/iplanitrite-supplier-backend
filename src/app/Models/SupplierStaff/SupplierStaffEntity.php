<?php

declare(strict_types=1);

namespace App\Models\SupplierStaff;

use App\Classes\Cast\CarbonCast;
use App\Classes\Cast\UuidCast;
use App\Classes\Principals\PrincipalData;
use App\Classes\Scopes\Guard\GuardedAuthenticatedModel;
use App\Enums\AuthGuardType;
use App\Models\Address\AddressEntity;
use App\Models\ContactNumber\ContactNumberEntity;
use App\Models\SupplierStaff\Context\SupplierStaffContext;
use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Models\SupplierStaff\Context\SupplierStaffModelContextType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\UuidInterface;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SupplierStaffEntity extends GuardedAuthenticatedModel implements JWTSubject
{
    use SoftDeletes;

    protected string $guard = 'SUPPLIER_STAFF';

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
     * @throws SupplierStaffContextException
     */
    public function buildContext($contexts): SupplierStaffContext
    {
        $addressContext = null;
        $contactNumberContext = null;
        foreach ($contexts as $context) {
            switch ($context) {
                case SupplierStaffModelContextType::ADDRESS:
                    /** @var AddressEntity $address */
                    $address = $this->address;
                    $addressContext = $address->toModel();
                    break;
                case SupplierStaffModelContextType::CONTACT_NUMBER:
                    /** @var ContactNumberEntity $contactNumber */
                    $contactNumber = $this->contactNumber;
                    $contactNumberContext = $contactNumber->toModel();
                    break;
                default:
                    throw new SupplierStaffContextException("Invalid context $context");
            }
        }

        return new SupplierStaffContext(
            address: $addressContext,
            contactNumber: $contactNumberContext
        );
    }

    public function toPrincipalData(): PrincipalData
    {
        return new PrincipalData(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            type: AuthGuardType::SUPPLIER_STAFF,
            guardId: $this->supplier_id
        );
    }
}
