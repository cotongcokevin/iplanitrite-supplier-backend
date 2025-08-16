<?php

declare(strict_types=1);

namespace App\Classes\Cast;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?UuidInterface
    {
        return $value ? Uuid::fromString($value) : null;
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value instanceof UuidInterface) {
            return $value->toString();
        }

        return $value; // assume it's already a string or null
    }
}
