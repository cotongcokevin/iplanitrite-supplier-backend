<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class SupplierTemplateChecklistSortRequestDto
{
    /**
     * @param array<string, int> $data
     */
    public function __construct(
        public array $data,
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateChecklistSortRequestDto
    {
        $request->validate([
            'data' => ['required'],
        ]);

        return new SupplierTemplateChecklistSortRequestDto(
            $request->data,
        );
    }
}
