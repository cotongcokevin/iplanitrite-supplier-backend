<?php

declare(strict_types=1);

namespace App\Repositories\SupplierStaffRepository;

use App\Classes\Pair;
use App\Classes\Principals\Principal;
use App\Models\SupplierStaff\Context\SupplierStaffContext;
use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Models\SupplierStaff\Context\SupplierStaffContextType;
use App\Models\SupplierStaff\SupplierStaffEntity;
use App\Models\SupplierStaff\SupplierStaffModel;
use App\Repositories\SupplierStaffRepository\Data\SupplierStaffUpdateProfileRepoData;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffRepository
{
    public function __construct(private Principal $principal) {}

    /**
     * @throws SupplierStaffContextException
     */
    public function search(): Collection
    {
        $supplierStaffList = SupplierStaffEntity::get();

        return $supplierStaffList->map(function (SupplierStaffEntity $supplierStaff) {
            return $supplierStaff->toModel();
        });
    }

    public function searchWithContext(array $contexts): Collection
    {
        $entities = SupplierStaffEntity::with($contexts)
            ->orderByDesc('created_at')
            ->get();

        return $entities->map(
            fn (SupplierStaffEntity $entity) => new Pair($entity->toModel(), $entity->buildContext($contexts))
        );
    }

    public function create(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        Carbon $dateOfBirth,
        UuidInterface $supplierRoleId,
        ?UuidInterface $contactNumberId,
        ?UuidInterface $addressId,
    ): void {
        $staff = new SupplierStaffEntity;
        $staff->id = Uuid::uuid4();
        $staff->first_name = $firstName;
        $staff->last_name = $lastName;
        $staff->email = $email;
        $staff->password = $password;
        $staff->date_of_birth = $dateOfBirth;
        $staff->supplier_id = $this->principal::get()->guardId;
        $staff->supplier_role_id = $supplierRoleId;
        $staff->created_by = $this->principal::get()->id;
        $staff->updated_by = $this->principal::get()->id;
        $staff->created_at = Carbon::now();
        $staff->contact_number_id = $contactNumberId;
        $staff->address_id = $addressId;
        $staff->save();
    }

    public function getById(
        UuidInterface $id,
    ): SupplierStaffModel {
        /** @var SupplierStaffEntity $result */
        $result = SupplierStaffEntity::find($id);

        return $result->toModel();
    }

    /**
     * @param  SupplierStaffContextType[]  $contexts
     * @return Pair<SupplierStaffModel, SupplierStaffContext>
     */
    public function getByIdWithContext(
        UuidInterface $id,
        array $contexts
    ): Pair {
        /** @var SupplierStaffEntity $result */
        $result = SupplierStaffEntity::with($contexts)->find($id);

        return new Pair(
            $result->toModel(),
            $result->buildContext($contexts)
        );
    }

    public function updateProfile(
        SupplierStaffUpdateProfileRepoData $data,
        UuidInterface $id,
    ): void {
        /** @var SupplierStaffEntity $result */
        $supplierStaff = SupplierStaffEntity::find($id);
        if ($data->password !== null) {
            $supplierStaff->password = bcrypt($data->password);
        }
        $supplierStaff->first_name = $data->firstName;
        $supplierStaff->last_name = $data->lastName;
        $supplierStaff->date_of_birth = $data->dateOfBirth;
        $supplierStaff->contact_number_id = $data->contactNumberId;
        $supplierStaff->address_id = $data->addressId;
        $supplierStaff->save();
    }
}
