<?php

declare(strict_types=1);

namespace App\Repositories\SupplierStaffRepository;

use App\Models\SupplierStaff\SupplierStaff;
use App\Models\SupplierStaff\SupplierStaffModelData;
use App\Repositories\SupplierStaffRepository\Data\SupplierStaffUpdateProfileRepoData;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffRepository
{
    public function getById(UuidInterface $id): SupplierStaffModelData
    {
        $result = SupplierStaff::find($id);

        return $result->toModelData();
    }

    public function updateProfile(
        SupplierStaffUpdateProfileRepoData $data,
        UuidInterface $id,
    ) {
        $supplierStaff = SupplierStaff::find($id);
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
