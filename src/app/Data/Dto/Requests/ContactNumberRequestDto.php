<?php

declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ContactNumberRequestDto
{
    public function __construct(
        public ?UuidInterface $id = null,          // present => update existing
        public ?string $number = null,             // optional on update; required on create
        public ?UuidInterface $countryId = null,   // optional on update; required on create
        public array $provided = [],               // which keys client sent (incl. null)
    ) {}

    public static function rules(string $prefix = 'contactNumber', bool $update = false): array
    {
        return [
            $prefix => ['sometimes', 'nullable', 'array'],

            "$prefix.id" => $update
                ? ['uuid', Rule::requiredIf(fn () => is_array(request($prefix)))]
                : ['sometimes', 'uuid'],

            // If NO id -> require both fields to allow "create during update"
            "{$prefix}.number" => ['sometimes', 'nullable', 'string', 'max:64', "required_without:{$prefix}.id"],
            "{$prefix}.countryId" => ['sometimes', 'nullable', 'uuid', "required_without:{$prefix}.id"],
        ];
    }

    public static function fromValidated(array $v, string $prefix = 'contactNumber'): ?self
    {
        if (! isset($v[$prefix])) {
            return null; // key absent => no change
        }

        $c = $v[$prefix];
        $provided = array_keys($c);

        $id = array_key_exists('id', $c) && $c['id'] !== null ? Uuid::fromString($c['id']) : null;
        $countryId = array_key_exists('countryId', $c) && $c['countryId'] !== null
            ? Uuid::fromString($c['countryId'])
            : null;

        return new self(
            id: $id,
            number: array_key_exists('number', $c) ? $c['number'] : null,
            countryId: $countryId,
            provided: $provided,
        );
    }

    public function provided(string $key): bool
    {
        return in_array($key, $this->provided, true);
    }
}
