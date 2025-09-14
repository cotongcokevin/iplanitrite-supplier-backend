<?php

declare(strict_types=1);

namespace App\Services;

use App\Classes\Pair;
use App\Data\Dto\Requests\SupplierStaffCreateRequestDto;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

readonly class SupplierStaffService
{
    public function __construct(private SupplierStaffRepository $supplierStaffRepository, private ContactNumberService $contactNumberService,private AddressService $addressService) {}

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
            password: $dto->password,
            dateOfBirth: $dto->dateOfBirth,
            supplierRoleId: $dto->supplierRoleId,
            contactNumberId: $contactId,
            addressId: $addressId,
        );
    }

    public function update(
        SupplierStaffCreateRequestDto $dto,
        UuidInterface                 $id,
    ): void {
        $contactId = null;
        if ($dto->contactNumber) {
            $contactId = $this->contactNumberService->upsert($dto->contactNumber->number, $dto->contactNumber->countryId);
        }

        $this->supplierStaffRepository->create(
            firstName: $dto->firstName,
            lastName: $dto->lastName,
            email: $dto->email,
            password: $dto->password,
            dateOfBirth: $dto->dateOfBirth,
            supplierRoleId: $dto->supplierRoleId,
            contactNumberId: $contactId,
        );
    }


}
