<?php

declare(strict_types=1);

namespace App\Services;

use App\Classes\Env\Env;
use App\Repositories\ContactNumberRepository\ContactNumberRepository;
use App\Repositories\ContactNumberRepository\Data\ContactRepositoryUpsertRepoData;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;

readonly class ContactNumberService
{
    public function __construct(
        private ContactNumberRepository $contactNumberRepository,
        private UuidFactory $uuid,
        private Env $env
    ) {}

    public function upsert(
        string $number,
        ?UuidInterface $uuid,
    ): UuidInterface {

        $contactId = $uuid ?? $this->uuid->uuid4();

        $this->contactNumberRepository->upsert(new ContactRepositoryUpsertRepoData(
            $contactId,
            $number,
            $this->env::get()->countryId
        ));

        return $contactId;

    }
}
