<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use App\Enums\SupplierTemplateChecklistGroupAccountableTo;
use App\Enums\SupplierTemplateChecklistGroupSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SupplierTemplateChecklistGroupServiceCreateRequestDto
{
    public function __construct(
        public SupplierTemplateChecklistGroupSection $section,
        public SupplierTemplateChecklistGroupAccountableTo $accountableTo,
        public string $name,
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateChecklistGroupServiceCreateRequestDto
    {
        $request->validate([
            'section' => ['required', new Enum(SupplierTemplateChecklistGroupSection::class)],
            'accountableTo' => ['required', new Enum(SupplierTemplateChecklistGroupAccountableTo::class)],
            'name' => 'required',
        ]);

        return new SupplierTemplateChecklistGroupServiceCreateRequestDto(
            SupplierTemplateChecklistGroupSection::from($request->section),
            SupplierTemplateChecklistGroupAccountableTo::from($request->accountableTo),
            $request->name
        );
    }
}
