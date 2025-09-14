<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class SupplierStaffUpdateRequestDto
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?string $password = null,
        public ?Carbon $dateOfBirth = null,
        public ?UuidInterface $supplierRoleId = null,
        public ?ContactNumberRequestDto $contactNumber = null,
        public ?AddressRequestDto $address = null,
        public array $provided = [],  // <— top-level provided keys
    ) {}

    /**
     * @throws ValidationException
     */
    public static function fromRequest(Request $request): self
    {
        $input = $request->all();

        // Treat blank password as "not provided"
        if (array_key_exists('password', $input) && blank($input['password'])) {
            unset($input['password']);
        }

        $v = validator($input, [
            'firstName' => ['sometimes', 'string'],
            'lastName' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email'],
            'password' => ['sometimes', 'string'], // only validated if present (non-blank)
            'dateOfBirth' => ['sometimes', 'nullable', 'date'],
            'supplierRoleId' => ['sometimes', 'uuid'],
            ...ContactNumberRequestDto::rules('contactNumber', true),
            ...AddressRequestDto::rules('address', true),
        ])->validate();

        $provided = array_keys($v); // includes keys present (even if null)

        return new self(
            firstName: $v['firstName'] ?? null,
            lastName: $v['lastName'] ?? null,
            email: $v['email'] ?? null,
            password: array_key_exists('password', $v) ? $v['password'] : null,
            dateOfBirth: array_key_exists('dateOfBirth', $v)
                ? ($v['dateOfBirth'] !== null ? Carbon::parse($v['dateOfBirth']) : null)
                : null,
            supplierRoleId: array_key_exists('supplierRoleId', $v) ? Uuid::fromString($v['supplierRoleId']) : null,
            contactNumber: ContactNumberRequestDto::fromValidated($v, 'contactNumber'),
            address: AddressRequestDto::fromValidated($v, 'address'),
            provided: $provided,
        );
    }

    public function provided(string $key): bool
    {
        return in_array($key, $this->provided, true);
    }
}
