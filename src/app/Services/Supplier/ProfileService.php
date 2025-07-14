<?php

declare(strict_types=1);

namespace App\Services\Supplier;

use App\Classes\Pair;
use App\Classes\Principals\Principal;
use App\Dto\Requests\Staff\UpdateProfileRequestDto;
use App\Models\SupplierStaff\Context\SupplierStaffContext;
use App\Models\SupplierStaff\Context\SupplierStaffContextException;
use App\Models\SupplierStaff\Context\SupplierStaffModelContextType;
use App\Models\SupplierStaff\SupplierStaffModel;
use App\Repositories\SupplierStaffRepository\Data\SupplierStaffUpdateProfileRepoData;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use App\Services\AddressService;
use App\Services\ContactNumberService;
use Carbon\Carbon;

readonly class ProfileService
{
    public function __construct(
        private Principal $principal,
        private SupplierStaffRepository $supplierStaffRepository,
        private AddressService $addressService,
        private ContactNumberService $contactNumberService,
    ) {}

    /**
     * @return Pair<SupplierStaffModel, SupplierStaffContext>
     *
     * @throws SupplierStaffContextException
     */
    public function get(): Pair
    {
        return $this->supplierStaffRepository
            ->getByIdWithContext(
                $this->principal::get()->id, [
                    SupplierStaffModelContextType::ADDRESS,
                    SupplierStaffModelContextType::CONTACT_NUMBER,
                ]
            );
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
