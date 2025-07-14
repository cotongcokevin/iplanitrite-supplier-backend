<?php

declare(strict_types=1);

namespace App\Services\Staff;

use App\Classes\Principals\SupplierStaffPrincipal;
use App\Dto\Requests\Staff\UpdateProfileRequestDto;
use App\Models\SupplierStaff\SupplierStaffModelData;
use App\Repositories\SupplierStaffRepository\Data\SupplierStaffUpdateProfileRepoData;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use App\Services\AddressService;
use App\Services\ContactNumberService;
use Carbon\Carbon;

readonly class ProfileService
{
    public function __construct(
        private SupplierStaffPrincipal $principal,
        private SupplierStaffRepository $supplierStaffRepository,
        private AddressService $addressService,
        private ContactNumberService $contactNumberService,
    ) {}

    public function get(): SupplierStaffModelData
    {
        return $this->supplierStaffRepository->getById($this->principal::get()->id);
    }

    public function update(UpdateProfileRequestDto $request): void
    {
        $id = $this->principal::get()->id;
        $supplierStaff = $this->supplierStaffRepository->getById($id);

        $addressId = $this->addressService->upsert(
            $request->address,
            $supplierStaff->addressId
        );

        $contactNumberId = $this->contactNumberService->upsert(
            $request->contactNumber,
            $supplierStaff->addressId
        );

        $this->supplierStaffRepository->updateProfile(
            new SupplierStaffUpdateProfileRepoData(
                password: $request->password,
                firstName: $request->firstName,
                lastName: $request->lastName,
                dateOfBirth: $request->dateOfBirth,
                contactNumberId: $contactNumberId,
                addressId: $addressId,
                updatedBy: $id,
                updatedAt: Carbon::now()
            ),
            $id,
        );
    }
}
