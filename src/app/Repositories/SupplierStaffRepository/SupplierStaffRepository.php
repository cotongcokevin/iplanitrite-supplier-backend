<?php

declare(strict_types=1);

namespace App\Repositories\SupplierStaffRepository;

use App\Classes\Pair;
use App\Models\SupplierStaff\Context\SupplierStaffContext;
use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Models\SupplierStaff\Context\SupplierStaffModelContextType;
use App\Models\SupplierStaff\SupplierStaffEntity;
use App\Models\SupplierStaff\SupplierStaffModel;
use App\Repositories\SupplierStaffRepository\Data\SupplierStaffUpdateProfileRepoData;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffRepository
{
    public function getById(
        UuidInterface $id,
    ): SupplierStaffModel {
        $result = SupplierStaffEntity::find($id);

        return $result->toModel();
    }

    /**
     * @param  SupplierStaffModelContextType[]  $contexts
     * @return Pair<SupplierStaffModel, SupplierStaffContext>
     *
     * @throws SupplierStaffContextException
     */
    public function getByIdWithContext(
        UuidInterface $id,
        array $contexts
    ): Pair {
        $contextNames = array_map(
            fn ($context) => ($context->value),
            $contexts
        );
        /** @var SupplierStaffEntity $result */
        $result = SupplierStaffEntity::with($contextNames)->find($id);

        return new Pair(
            $result->toModel(),
            $result->buildContext($contexts)
        );
    }

    public function updateProfile(
        SupplierStaffUpdateProfileRepoData $data,
        UuidInterface $id,
    ): void {
        $supplierStaff = SupplierStaffEntity::find($id);
        if ($data->password !== null) {
            $supplierStaff->password = $data->password;
        }
        $supplierStaff->first_name = $data->firstName;
        $supplierStaff->last_name = $data->lastName;
        $supplierStaff->date_of_birth = $data->dateOfBirth;
        $supplierStaff->contact_number_id = $data->contactNumberId;
        $supplierStaff->address_id = $data->addressId;
        $supplierStaff->save();
    }
}
