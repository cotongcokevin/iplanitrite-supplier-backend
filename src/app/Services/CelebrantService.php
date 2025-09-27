<?php

namespace App\Services;

use App\Data\Dto\Requests\CelebrantRequestDto;
use App\Repositories\CelebrantRepository\CelebrantRepository;
use App\Repositories\CelebrantRepository\Data\CelebrantUpsertRepoData;
use Ramsey\Uuid\UuidInterface;

readonly class CelebrantService
{
    public function __construct(
        private CelebrantRepository $celebrantRepository,
        private AddressService $addressService,
        private ContactNumberService $contactNumberService
    ) {}

    public function create(CelebrantRequestDto $request): UuidInterface
    {
        $addressId = null;
        if ($request->address) {
            $addressId = $this->addressService->upsert(
                $request->address,
                null
            );
        }

        $contactNumberId = null;
        if ($request->contactNumber) {
            $contactNumberId = $this->contactNumberService->upsert(
                $request->contactNumber,
                null
            );
        }

        return $this->celebrantRepository->create(
            new CelebrantUpsertRepoData(
                title: $request->title,
                firstName: $request->firstName,
                lastName: $request->lastName,
                addressId: $addressId,
                contactNumberId: $contactNumberId
            )
        );
    }
}
