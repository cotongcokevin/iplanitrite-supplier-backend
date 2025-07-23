<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Classes\Pair;
use App\Data\Dto\ResponseDto;
use App\Models\Client\ClientModel;
use App\Models\Client\Context\ClientContext;
use App\Models\Client\Context\ClientContextType;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class ClientDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?ClientContextDto $context = null
    ) {}

    /**
     * @param  Pair<ClientModel, ClientContext>  $clientWithContext
     * @param  ClientContextType[]  $expectedContexts
     */
    public static function buildFromContextPair(
        Pair $clientWithContext,
        array $expectedContexts,
    ): ClientDto {
        $client = $clientWithContext->first;
        $context = $clientWithContext->second->toDto($expectedContexts);

        return new ClientDto(
            id: $client->id,
            email: $client->email,
            password: $client->password,
            firstName: $client->firstName,
            lastName: $client->lastName,
            createdAt: $client->createdAt,
            updatedAt: $client->updatedAt,
            deletedAt: $client->deletedAt,
            context: $context
        );
    }
}
