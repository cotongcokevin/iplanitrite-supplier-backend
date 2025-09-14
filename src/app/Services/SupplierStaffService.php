<?php

declare(strict_types=1);

namespace App\Services;

use App\Classes\Pair;
use App\Data\Dto\Requests\SupplierStaffCreateRequestDto;
use App\Data\Dto\Requests\SupplierStaffUpdateRequestDto;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierStaffService
{
    public function __construct(private SupplierStaffRepository $supplierStaffRepository, private ContactNumberService $contactNumberService, private AddressService $addressService) {}

    public function searchWithContext(array $contexts): Collection
    {
        return $this->supplierStaffRepository->searchWithContext($contexts);
    }

    public function getByIdWithContext(UuidInterface $id, array $contexts): Pair
    {
        return $this->supplierStaffRepository->getByIdWithContext($id, $contexts);
    }

    public function create(
        SupplierStaffCreateRequestDto $dto
    ): void {
        $contactId = null;
        if ($dto->contactNumber) {
            $contactId = $this->contactNumberService->upsert($dto->contactNumber->number, $dto->contactNumber->countryId);
        }

        $addressId = null;
        if ($dto->address) {
            $addressId = $this->addressService->upsert($dto->address);
        }

        $this->supplierStaffRepository->create(
            firstName: $dto->firstName,
            lastName: $dto->lastName,
            email: $dto->email,
            password: Hash::make($dto->password),
            dateOfBirth: $dto->dateOfBirth,
            supplierRoleId: $dto->supplierRoleId,
            contactNumberId: $contactId,
            addressId: $addressId,
        );
    }

    public function update(
        SupplierStaffUpdateRequestDto $dto,
        UuidInterface $id,
    ): void {
        $updates = [];

        if ($dto->provided('firstName')) {
            $updates['first_name'] = $dto->firstName;
        }
        if ($dto->provided('lastName')) {
            $updates['last_name'] = $dto->lastName;
        }
        if ($dto->provided('email')) {
            $updates['email'] = $dto->email;
        }

        // dateOfBirth: allow explicit null to clear the value
        if ($dto->provided('dateOfBirth')) {
            $updates['date_of_birth'] = $dto->dateOfBirth;
        }
        if ($dto->provided('supplierRoleId')) {
            $updates['supplier_role_id'] = $dto->supplierRoleId;
        }

        // Only touch password if the client actually sent it (non-empty due to 'filled')
        if ($dto->provided('password')) {
            $updates['password'] = Hash::make($dto->password);
        }

        // Nested: only touch if group was provided.
        if ($dto->provided('contactNumber')) {
            $contactId = $dto->contactNumber
                ? $this->contactNumberService->upsert($dto->contactNumber->number, $dto->contactNumber->countryId, $dto->contactNumber->id)
                : null; // if you support explicit null to clear
            $updates['contact_number_id'] = $contactId;
        }

        if ($dto->provided('address')) {
            $addressId = $dto->address
                ? $this->addressService->upsert($dto->address, $dto->address->id)
                : null; // explicit clear
            $updates['address_id'] = $addressId;
        }

        if (empty($updates)) {
            // nothing to change; you can early-return or still bump audit fields
            return;
        }

        $this->supplierStaffRepository->update(
            id: $id,
            attributes: $updates
        );
    }

    public function destroy(UuidInterface $id): void
    {
        $this->supplierStaffRepository->destroy($id);
    }
}
