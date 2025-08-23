<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;

class SupplierTemplateChecklistCreateRequestDto
{
    public function __construct(
        public string $description
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateChecklistCreateRequestDto
    {
        $request->validate([
            'description' => ['required', 'min:1'],
        ]);

        return new SupplierTemplateChecklistCreateRequestDto(
            $request->description
        );
    }
}
