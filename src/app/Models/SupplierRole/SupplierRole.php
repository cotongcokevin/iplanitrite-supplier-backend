<?php

declare(strict_types=1);

namespace App\Models\SupplierRole;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class SupplierRole extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'supplier_role';

    public function toModelData(): SupplierRoleModelData
    {
        return new SupplierRoleModelData(
            id: Uuid::fromString($this->id),
            name: $this->name,
            immutable: $this->immutable,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by ? Uuid::fromString($this->created_by) : null,
            updatedBy: $this->updated_by ? Uuid::fromString($this->updated_by) : null,
            createdAt: $this->createdAt ? Carbon::parse($this->created_at) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updated_at) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deleted_at) : null,
        );
    }
}
