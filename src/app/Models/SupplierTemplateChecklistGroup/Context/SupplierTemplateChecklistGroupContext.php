<?php

declare(strict_types=1);

namespace App\Models\SupplierTemplateChecklistGroup\Context;

use App\Data\Dto\Response\SupplierTemplateChecklistGroupContextDto;
use App\Models\SupplierTemplateChecklist\SupplierTemplateChecklistModel;
use BackedEnum;
use Illuminate\Support\Collection;

readonly class SupplierTemplateChecklistGroupContext
{
    /**
     * @param  Collection<SupplierTemplateChecklistModel>  $checklists
     */
    public function __construct(
        private Collection $checklists,
    ) {}

    /**
     * @param  BackedEnum[]  $expectedContexts
     */
    public function toDto(array $expectedContexts): SupplierTemplateChecklistGroupContextDto
    {
        $result = new SupplierTemplateChecklistGroupContextDto(
            $this->checklists->map(
                fn (SupplierTemplateChecklistModel $checkList) => $checkList->toDto()
            ),
        );

        $result->setExpectedContexts($expectedContexts);

        return $result;
    }
}
