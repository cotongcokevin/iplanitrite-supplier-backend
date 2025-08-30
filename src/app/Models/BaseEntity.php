<?php

declare(strict_types=1);

namespace App\Models;

use BackedEnum;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Closure;

class BaseEntity extends Model
{
    public static function with($relations): Builder
    {
        $relations = is_string($relations[0])
            ? $relations
            : array_map(function (BackedEnum $relation) {
                return $relation->value;
            }, $relations);

        return parent::with($relations);
    }

    /**
     * @throws Exception
     */
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            if (! $this->relationLoaded($key)) {
                throw new Exception("$key relationship not yet loaded.");
            }
        }

        return parent::__get($key);
    }
}
