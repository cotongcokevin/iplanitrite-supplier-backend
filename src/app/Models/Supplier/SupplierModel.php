<?php

declare(strict_types=1);

namespace App\Models\Supplier;

use App\Data\Dto\Response\SupplierDto;
use App\Enums\SubscriptionTier;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierModel
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

    public function toDto(): SupplierDto
    {
        return new SupplierDto(
            id: $this->id,
            name: $this->name,
            description: $this->description,
            subscriptionTier: $this->subscriptionTier,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
            deletedAt: $this->deletedAt,
        );
    }
}
