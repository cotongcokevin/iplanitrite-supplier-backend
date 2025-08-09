<?php

declare(strict_types=1);

namespace App\Repositories\SupplierRepository\Data;

use App\Enums\SubscriptionTier;

class SupplierRepositoryUpdateData
{
    public function __construct(
        public string $name,
        public ?string $description,
        public SubscriptionTier $subscriptionTier
    ) {}
}
