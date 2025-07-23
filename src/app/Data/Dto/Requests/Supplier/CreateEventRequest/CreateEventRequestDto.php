<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests\Supplier\CreateEventRequest;

use App\Data\Dto\Requests\NameRequestDto;
use App\Data\Dto\Requests\Supplier\SupplierStoreRequestDto;
use App\Enums\EventType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class CreateEventRequestDto extends Data
{
    private function __construct(
        public string $name,
        public EventType $type,
        public ?Carbon $date,
        public ?string $location,
        public ?string $notes,
        public NameRequestDto $celebrantOne,
        public ?NameRequestDto $celebrantTwo,
        public CreateEventClientDetailsRequestDto $clientDetails
    ) {}

    public static function fromRequest(Request $request): SupplierStoreRequestDto
    {
        $eventType = EventType::from($request->type);
        $validation = [
            'name' => 'required',
            'type' => 'required',
            'date' => 'required|date',
            'celebrantOne' => 'required',
            'celebrantOne.firstName' => 'required',
            'celebrantOne.lastName' => 'required',
            'clientDetails' => 'required',
            'clientDetails.firstName' => 'required',
            'clientDetails.lastName' => 'required',
            'clientDetails.email' => 'required|email',
        ];
        switch ($eventType) {
            case EventType::WEDDING:
            case EventType::ANNIVERSARY_COUPLE:
                $validation['celebrantTwo.firstName'] = 'required';
                $validation['celebrantTwo.lastName'] = 'required';
                $request->validate($validation);

                CreateEventRequestDto::from($request);
                break;

            case EventType::BAPTISM:
            case EventType::ENGAGEMENT:
            case EventType::BRIDAL_SHOWER:
            case EventType::BABY_SHOWER:
            case EventType::DEBUT:
            case EventType::BIRTHDAY:
            case EventType::ANNIVERSARY:
            case EventType::CORPORATE_EVENT:
                $request->validate($validation);
                break;
        }
    }
}
