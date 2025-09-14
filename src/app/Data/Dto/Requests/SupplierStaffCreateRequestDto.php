<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffCreateRequestDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public Carbon $dateOfBirth,
        public UuidInterface $supplierRoleId,
        public ?ContactNumberCreateRequestDto $contactNumber = null,
        public ?AddressRequestDto $address = null,
    ) {}

    public static function fromRequest(Request $request): SupplierStaffCreateRequestDto
    {
        $validated = $request->validate([
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'dateOfBirth' => ['date'],
            'supplierRoleId' => ['required', 'uuid'],
            // Nested: contactNumber
            'contactNumber.number' => ['nullable', 'string', 'max:64'],
            'contactNumber.countryId' => ['nullable', 'uuid'],

        ]);

        return new self(
            firstName: $validated['firstName'],
            lastName: $validated['lastName'],
            email: $validated['email'],
            password: Hash::make($validated['password']),
            dateOfBirth: ! empty($validated['dateOfBirth']) ? Carbon::parse($validated['dateOfBirth']) : null,
            supplierRoleId: Uuid::fromString($validated['supplierRoleId']),
            contactNumber: ! empty($validated['contactNumber']['number'] ?? null)
                ? new ContactNumberCreateRequestDto($validated['contactNumber']['number'], Uuid::fromString($validated['contactNumber']['countryId']))
                : null,
        );
    }
}
