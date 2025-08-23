<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseContext;
use Illuminate\Support\Collection;

class SupplierTemplateChecklistGroupContextDto extends ResponseContext
{
    /**
     * @param  Collection<SupplierTemplateChecklistDto>  $checklists
     */
    public function __construct(
        public Collection $checklists
    ) {}
}
