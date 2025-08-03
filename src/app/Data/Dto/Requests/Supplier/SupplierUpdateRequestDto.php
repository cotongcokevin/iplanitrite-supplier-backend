<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Supplier;

use App\Enums\SubscriptionTier;
use Illuminate\Http\Request;

class SupplierUpdateRequestDto
{
    private function __construct(
        public string $name,
        public string $description,
        public SubscriptionTier $subscriptionTier
    ) {}

    public static function fromRequest(Request $request): SupplierUpdateRequestDto
    {
        $request->validate([
            'name' => 'required',
            'subscriptionTier' => 'required',
        ]);

        return new SupplierUpdateRequestDto(
            name: $request->name,
            description: $request->description,
            subscriptionTier: SubscriptionTier::from($request->subscriptionTier),
        );
    }
}
