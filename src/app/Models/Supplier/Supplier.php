<?php

declare(strict_types=1);

namespace App\Models\Supplier;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Supplier extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'supplier';

    public function toModelData(): SupplierModelData
    {
        return new SupplierModelData(
            id: Uuid::fromString($this->id),
            name: $this->name,
            description: $this->description,
            maxStaff: $this->max_staff,
            createdBy: $this->created_by ? Uuid::fromString($this->created_by) : null,
            updatedBy: $this->updated_by ? Uuid::fromString($this->updated_by) : null,
            createdAt: $this->createdAt ? Carbon::parse($this->created_at) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updated_at) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deleted_at) : null,
        );
    }
}
