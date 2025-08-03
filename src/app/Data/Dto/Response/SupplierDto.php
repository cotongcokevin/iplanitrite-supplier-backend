<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Enums\SubscriptionTier;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $name,
        public ?string $description,
        public SubscriptionTier $subscriptionTier,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
