<?php

declare(strict_types=1);

namespace App\Classes\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CarbonCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?Carbon
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value instanceof Carbon) {
            return $value->toString();
        }

        return $value; // assume it's already a string or null
    }
}
