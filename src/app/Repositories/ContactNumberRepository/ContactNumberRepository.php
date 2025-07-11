<?php

declare(strict_types=1);

namespace App\Repositories\ContactNumberRepository;

use App\Classes\Accountable;
use Ramsey\Uuid\UuidFactory;

class ContactNumberRepository
{
    private Accountable $accountable;

    private UuidFactory $uuid;

    public function __construct(
        Accountable $accountable,
        UuidFactory $uuid
    ) {
        $this->accountable = $accountable;
        $this->uuid = $uuid;
    }
}
