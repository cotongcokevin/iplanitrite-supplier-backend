<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Supplier;

use Illuminate\Http\Request;

class SupplierUpdateRequestDto
{
    private function __construct(
        public string $name,
        public string $description,
        public int $maxStaff
    ) {}

    public static function fromRequest(Request $request): SupplierUpdateRequestDto
    {
        $request->validate([
            'name' => 'required',
            'maxStaff' => 'required|numeric',
        ]);

        return new SupplierUpdateRequestDto(
            name: $request->name,
            description: $request->description,
            maxStaff: $request->maxStaff,
        );
    }
}
