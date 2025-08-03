<?php

declare(strict_types=1);

namespace App\Models\Supplier;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Enums\SubscriptionTier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierEntity extends Model
{
    use SoftDeletes;

    /**
     * $keyType is the type of the id of the table which is UUID
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string
     */
    protected $table = 'supplier';

    protected $casts = [
        'id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): SupplierModel
    {
        return new SupplierModel(
            id: $this->id,
            name: $this->name,
            description: $this->description,
            subscriptionTier: SubscriptionTier::from($this->subscription_tier),
            createdBy: $this->created_by ? $this->created_by : null,
            updatedBy: $this->updated_by ? $this->updated_by : null,
            createdAt: $this->createdAt ? $this->created_at : null,
            updatedAt: $this->updatedAt ? $this->updated_at : null,
            deletedAt: $this->deletedAt ? $this->deleted_at : null,
        );
    }
}
