<?php

declare(strict_types=1);

namespace App\Models\SupplierPermission;

use App\Enums\SupplierPermissionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class SupplierPermission extends Model
{
    /**
     * @var string
     */
    protected $table = 'supplier_permission';

    public function toModelData(): SupplierPermissionModelData
    {
        return new SupplierPermissionModelData(
            id: Uuid::fromString($this->id),
            name: SupplierPermissionType::from($this->name),
            supplierRoleId: $this->supplier_role_id,
            createdBy: $this->created_by ? Uuid::fromString($this->created_by) : null,
            updatedBy: $this->updated_by ? Uuid::fromString($this->updated_by) : null,
            createdAt: $this->createdAt ? Carbon::parse($this->created_at) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updated_at) : null,
        );
    }
}
