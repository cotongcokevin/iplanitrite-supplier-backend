<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class SupplierTemplateChecklistGroupServiceUpdateRequestDto
{
    public function __construct(
        public string $name,
        public int $sortOrder
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateChecklistGroupServiceUpdateRequestDto
    {
        $request->validate([
            'name' => 'required',
            'sortOrder' => ['required', 'integer'],
        ]);

        return new SupplierTemplateChecklistGroupServiceUpdateRequestDto(
            $request->name,
            $request->sortOrder,
        );
    }
}
