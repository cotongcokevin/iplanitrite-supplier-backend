<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffCreateRequestDto
{
    public function __construct(
        public ?string $firstName,
        public ?string $lastName,
        public string $email,
        public string $password,
        public ?Carbon $dateOfBirth,
        public UuidInterface $supplierRoleId,
        public ?ContactNumberRequestDto $contactNumber = null,
        public ?AddressRequestDto $address = null,
    ) {}

    public static function fromRequest(Request $request): SupplierStaffCreateRequestDto
    {
        $validated = $request->validate([
            'firstName' => ['string'],
            'lastName' => ['string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'dateOfBirth' => ['date'],
            'supplierRoleId' => ['required', 'uuid'],
            ...ContactNumberRequestDto::rules('contactNumber'),
            ...AddressRequestDto::rules('address'),
        ]);

        // Contact Number DTO
        $contactNumber = ContactNumberRequestDto::fromValidated($validated, 'contactNumber');
        // Address DTO
        $address = AddressRequestDto::fromValidated($validated, 'address');

        return new self(
            firstName: $validated['firstName'] ?? '',
            lastName: $validated['lastName'] ?? '',
            email: $validated['email'],
            password: $validated['password'],
            dateOfBirth: ! empty($validated['dateOfBirth']) ? Carbon::parse($validated['dateOfBirth']) : null,
            supplierRoleId: Uuid::fromString($validated['supplierRoleId']),
            contactNumber: $contactNumber,
            address: $address,
        );
    }
}
