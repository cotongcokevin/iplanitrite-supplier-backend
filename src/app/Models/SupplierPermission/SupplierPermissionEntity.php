<?php

declare(strict_types=1);

namespace App\Models\SupplierPermission;

use App\Classes\Cast\CarbonCast;
use App\Classes\Cast\UuidCast;
use App\Enums\SupplierPermissionType;
use Illuminate\Database\Eloquent\Model;

class SupplierPermissionEntity extends Model
{
    /**
     * @var string
     */
    protected $table = 'supplier_permission';

    protected $casts = [
        'id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): SupplierPermissionModel
    {
        return new SupplierPermissionModel(
            id: $this->id,
            name: SupplierPermissionType::from($this->name),
            supplierRoleId: $this->supplier_role_id,
            createdBy: $this->created_by ? $this->created_by : null,
            updatedBy: $this->updated_by ? $this->updated_by : null,
            createdAt: $this->createdAt ? $this->created_at : null,
            updatedAt: $this->updatedAt ? $this->updated_at : null,
        );
    }
}
