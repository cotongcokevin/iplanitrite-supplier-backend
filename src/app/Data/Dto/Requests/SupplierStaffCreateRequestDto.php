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
        ]);

        return new SupplierStaffCreateRequestDto(
            $validated['firstName'],
            $validated['lastName'],
            $validated['email'],
            Hash::make($validated['password']),
            Carbon::parse($validated['dateOfBirth']),
            Uuid::fromString($validated['supplierRoleId']),
        );
    }
}
