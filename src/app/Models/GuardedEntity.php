<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Scopes\Guard\GuardQueryScope;
use BackedEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;

class GuardedEntity extends BaseEntity
{
    /**
     * @throws BindingResolutionException
     */
    protected static function booted(): void
    {
        $scope = app()->make(GuardQueryScope::class);
        static::addGlobalScope($scope);
    }

    public static function with($relations): Builder
    {
        $relations = is_string($relations[0])
            ? $relations
            : array_map(function (BackedEnum $relation) {
                return $relation->value;
            }, $relations);

        return parent::with($relations);
    }
}
