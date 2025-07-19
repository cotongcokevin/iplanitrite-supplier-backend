<?php

declare(strict_types=1);

namespace App\Models\SupplierRole;

use App\Classes\Cast\CarbonCast;
use App\Classes\Cast\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierRoleEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'supplier_role';

    protected $casts = [
        'id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): SupplierRoleModel
    {
        return new SupplierRoleModel(
            id: $this->id,
            name: $this->name,
            immutable: $this->immutable,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by ? $this->created_by : null,
            updatedBy: $this->updated_by ? $this->updated_by : null,
            createdAt: $this->createdAt ? $this->created_at : null,
            updatedAt: $this->updatedAt ? $this->updated_at : null,
            deletedAt: $this->deletedAt ? $this->deleted_at : null,
        );
    }
}
