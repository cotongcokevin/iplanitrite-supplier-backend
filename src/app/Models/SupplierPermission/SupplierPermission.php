<?php

declare(strict_types=1);

namespace App\Models\SupplierPermission;

use App\Enums\SupplierPermissionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SupplierPermission extends Model
{  
    
    /**
     * @var string
     */
    protected $table = 'supplier_permission';

    public function toModelData(): SupplierPermissionData
    {
        return new SupplierPermissionData(
            id: $this->id,
            name: SupplierPermissionType::from($this->name),
            supplierRoleId: $this->supplierRoleId,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
        );
    }
}
