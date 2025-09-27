<?php

namespace App\Services;

use App\Data\Dto\Requests\ClientRequestDto;
use App\Mail\OnClientCreated;
use App\Models\Client\ClientModel;
use App\Repositories\ClientRepository\ClientRepository;
use App\Repositories\ClientRepository\Data\ClientCreateRepoData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

readonly class ClientService
{
    public function __construct(
        private ClientRepository $clientRepository,
        private AddressService $addressService,
        private ContactNumberService $contactNumberService
    ) {}

    /**
     * @return Collection<ClientModel>
     */
    public function getByIds(array $ids): Collection
    {
        return $this->clientRepository->getByIds($ids);
    }

    public function getByEmail(string $email): ?ClientModel
    {
        return $this->clientRepository->getByEmail($email);
    }

    public function create(
        ClientRequestDto $request
    ): ClientModel {
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

        $client = $this->clientRepository->create(
            new ClientCreateRepoData(
                firstName: $request->firstName,
                lastName: $request->lastName,
                email: $request->email,
                password: bcrypt($request->password),
                addressId: $addressId,
                contactNumberId: $contactNumberId
            )
        );

        Mail::to($client->email)
            ->queue(new OnClientCreated($client));

        return $client;
    }
}
