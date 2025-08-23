<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SupplierTemplateChecklistGroupCreateRequestDto
{
    public function __construct(
        public SupplierTemplateChecklistGroupSection $section,
        public SupplierTemplateChecklistGroupAccountableTo $accountableTo,
        public string $name,
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateChecklistGroupCreateRequestDto
    {
        $request->validate([
            'section' => ['required', new Enum(SupplierTemplateChecklistGroupSection::class)],
            'accountableTo' => ['required', new Enum(SupplierTemplateChecklistGroupAccountableTo::class)],
            'name' => ['required', 'min:1'],
        ]);

        return new SupplierTemplateChecklistGroupCreateRequestDto(
            SupplierTemplateChecklistGroupSection::from($request->section),
            SupplierTemplateChecklistGroupAccountableTo::from($request->accountableTo),
            $request->name
        );
    }
}
