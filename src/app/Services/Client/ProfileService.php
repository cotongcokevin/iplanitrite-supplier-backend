<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Classes\Pair;
use App\Classes\Principals\Principal;
use App\Dto\Requests\Client\UpdateProfileRequestDto;
use App\Models\Client\ClientModel;
use App\Models\Client\Context\ClientContext;
use App\Models\Client\Context\ClientContextException;
use App\Models\Client\Context\ClientContextType;
use App\Repositories\ClientRepository\ClientRepository;
use App\Repositories\ClientRepository\Data\ClientUpdateProfileRepoData;
use App\Services\ContactNumberService;
use Carbon\Carbon;

readonly class ProfileService
{
    public function __construct(
        private Principal $principal,
        private ClientRepository $clientRepository,
        private ContactNumberService $contactNumberService,
    ) {}

    /**
     * @return Pair<ClientModel, ClientContext>
     *
     * @throws ClientContextException
     */
    public function get(): Pair
    {
        return $this->clientRepository
            ->getByIdWithContext(
                $this->principal::get()->id, [
                    ClientContextType::CONTACT_NUMBER,
                ]
            );
    }

    public function update(UpdateProfileRequestDto $request): void
    {
        $id = $this->principal::get()->id;
        $client = $this->clientRepository->getById($id);

        $contactNumberId = $this->contactNumberService->upsert(
            $request->contactNumber,
            $client->contactNumberId
        );

        $this->clientRepository->updateProfile(
            new ClientUpdateProfileRepoData(
                password: $request->password,
                firstName: $request->firstName,
                lastName: $request->lastName,
                contactNumberId: $contactNumberId,
                updatedBy: $id,
                updatedAt: Carbon::now()
            ),
            $id,
        );
    }
}
