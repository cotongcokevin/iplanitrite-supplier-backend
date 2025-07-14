<?php

declare(strict_types=1);

namespace App\Repositories\ContactNumberRepository;

use App\Models\ContactNumber\ContactNumberEntity;
use App\Repositories\ContactNumberRepository\Data\ContactRepositoryUpsertRepoData;

class ContactNumberRepository
{
    public function upsert(
        ContactRepositoryUpsertRepoData $data,
    ): void {
        ContactNumberEntity::upsert((array) $data, ['id']);
    }
}
