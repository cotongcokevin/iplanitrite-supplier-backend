<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use App\Enums\EventType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SupplierTemplateTimelineUpdateRequestDto
{

    public function __construct(
        public string $name,
        public bool $isRsvp,
    ) {}

    public static function fromRequest(Request $request): SupplierTemplateTimelineUpdateRequestDto
    {
        $request->validate([
            'name' => ['required'],
            'isRsvp' => ['required'],
        ]);

        return new SupplierTemplateTimelineUpdateRequestDto(
            $request->name,
            $request->isRsvp,
        );
    }
}