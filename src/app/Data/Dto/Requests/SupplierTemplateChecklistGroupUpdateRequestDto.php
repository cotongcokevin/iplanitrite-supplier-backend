<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class SupplierTemplateChecklistGroupUpdateRequestDto
{
    public function __construct(
        public string $name,
        public int $sortOrder
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateChecklistGroupUpdateRequestDto
    {
        $request->validate([
            'name' => ['required', 'min:1'],
            'sortOrder' => ['required', 'integer'],
        ]);

        return new SupplierTemplateChecklistGroupUpdateRequestDto(
            $request->name,
            $request->sortOrder,
        );
    }
}
