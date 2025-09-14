<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ContactNumberRepository\ContactNumberRepository;
use App\Repositories\ContactNumberRepository\Data\ContactRepositoryUpsertRepoData;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;

readonly class ContactNumberService
{
    public function __construct(
        private ContactNumberRepository $contactNumberRepository,
        private UuidFactory $uuid,
    ) {}

    public function upsert(
        string $number,
        UuidInterface $countryId,
        ?UuidInterface $uuid = null,
    ): UuidInterface {

        $contactId = $uuid ?? $this->uuid->uuid4();

        $this->contactNumberRepository->upsert(new ContactRepositoryUpsertRepoData(
            $number,
            $countryId,
            $contactId,
        ));

        return $contactId;

    }

    public function destroy(UuidInterface $id): void
    {
        $this->contactNumberRepository->destroy($id);
    }
}
