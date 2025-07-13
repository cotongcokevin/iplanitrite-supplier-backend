<?php

declare(strict_types=1);

namespace App\Models\SupplierRole;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierRole extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'supplier_role';

    public function toModelData(): SupplierRoleData
    {
        return new SupplierRoleData(
            id: $this->id,
            name: $this->name,
            immutable: $this->immutable,
            supplierId: $this->supplierId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deletedAt) : null,
        );
    }
}
