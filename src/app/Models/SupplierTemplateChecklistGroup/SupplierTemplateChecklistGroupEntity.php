<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateChecklistGroup;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Enums\EventType;
use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use App\Models\GuardedEntity;
use App\Models\SupplierTemplateChecklist\SupplierTemplateChecklistEntity;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContext;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextException;
use App\Models\SupplierTemplateChecklistGroup\Context\SupplierTemplateChecklistGroupContextType;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierTemplateChecklistGroupEntity extends GuardedEntity
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'supplier_template_checklist_group';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'supplier_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): SupplierTemplateChecklistGroupModel
    {
        return new SupplierTemplateChecklistGroupModel(
            id: $this->id,
            section: SupplierTemplateChecklistGroupSection::from($this->section),
            eventType: EventType::from($this->event_type),
            accountableTo: SupplierTemplateChecklistGroupAccountableTo::from($this->accountable_to),
            name: $this->name,
            sortOrder: $this->sort_order,
            supplierId: $this->supplier_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }

    public function checklists(): HasMany
    {
        return $this->hasMany(SupplierTemplateChecklistEntity::class, 'supplier_template_checklist_group_id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * @throws SupplierTemplateChecklistGroupContextException
     * @throws Exception
     */
    public function buildContext($contexts): SupplierTemplateChecklistGroupContext
    {
        $checklists = collect();
        foreach ($contexts as $context) {
            switch ($context) {
                case SupplierTemplateChecklistGroupContextType::CHECKLISTS:
                    $checklists = $this->checklists->map(
                        fn (SupplierTemplateChecklistEntity $checklist) => $checklist->toModel()
                    );
                    break;
                default:
                    throw new SupplierTemplateChecklistGroupContextException(
                        "Invalid context $context"
                    );
            }
        }

        return new SupplierTemplateChecklistGroupContext(
            checklists: $checklists,
        );
    }
}
