<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Scopes\Guard\GuardQueryScope;
use Illuminate\Contracts\Container\BindingResolutionException;

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
}
