<?php

namespace App\Services;

use App\Data\Dto\Requests\ClientRequestDto;
use App\Repositories\ClientRepository\ClientRepository;
use App\Repositories\ClientRepository\Data\ClientCreateRepoData;
use Ramsey\Uuid\UuidInterface;

readonly class ClientService
{
    public function __construct(
        private ClientRepository $clientRepository,
        private AddressService $addressService,
        private ContactNumberService $contactNumberService
    ) {}

    public function create(
        ClientRequestDto $request
    ): UuidInterface {
        $addressId = $this->addressService->upsert(
            $request->address,
            null
        );

        $contactNumberId = $this->contactNumberService->upsert(
            $request->number,
            null
        );

        $clientId = $this->clientRepository->create(
            new ClientCreateRepoData(
                firstName: $request->firstName,
                lastName: $request->lastName,
                email: $request->email,
                password: bcrypt($request->password),
                addressId: $addressId,
                contactNumberId: $contactNumberId
            )
        );

        // TODO: Send email here

        return $clientId;
    }
}
