<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateChecklist;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;

class SupplierTemplateChecklistEntity extends Model
{
    /**
     * @var string
     */
    protected $table = 'supplier_template_checklist';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'supplier_template_checklist_group_id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
    ];

    public function toModel(): SupplierTemplateChecklistModel
    {
        return new SupplierTemplateChecklistModel(
            id: $this->id,
            description: $this->description,
            sortOrder: $this->sort_order,
            supplierTemplateChecklistGroupId: $this->supplier_template_checklist_group_id,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
        );
    }
}
