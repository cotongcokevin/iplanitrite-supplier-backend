<?php

declare(strict_types=1);

namespace App\Repositories\ClientRepository;

use App\Classes\Pair;
use App\Models\Client\ClientEntity;
use App\Models\Client\ClientModel;
use App\Models\Client\Context\ClientContext;
use App\Models\Client\Context\ClientContextException;
use App\Models\Client\Context\ClientContextType;
use App\Repositories\ClientRepository\Data\ClientUpdateProfileRepoData;
use Ramsey\Uuid\UuidInterface;

readonly class ClientRepository
{
    public function getById(
        UuidInterface $id,
    ): ClientModel {
        /** @var ClientEntity $result */
        $result = ClientEntity::find($id);

        return $result->toModel();
    }

    /**
     * @param  ClientContextType[]  $contexts
     * @return Pair<ClientModel, ClientContext>
     *
     * @throws ClientContextException
     */
    public function getByIdWithContext(
        UuidInterface $id,
        array $contexts
    ): Pair {
        $contextNames = array_map(
            fn ($context) => ($context->value),
            $contexts
        );
        /** @var ClientEntity $result */
        $result = ClientEntity::with($contextNames)->find($id);

        return new Pair(
            $result->toModel(),
            $result->buildContext($contexts)
        );
    }

    public function updateProfile(
        ClientUpdateProfileRepoData $data,
        UuidInterface $id,
    ): void {
        /** @var ClientEntity $result */
        $client = ClientEntity::find($id);
        if ($data->password !== null) {
            $client->password = bcrypt($data->password);
        }
        $client->first_name = $data->firstName;
        $client->last_name = $data->lastName;
        $client->contact_number_id = $data->contactNumberId;
        $client->save();
    }
}
