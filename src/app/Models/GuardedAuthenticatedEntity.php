<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Scopes\Guard\GuardQueryScope;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Container\BindingResolutionException;

class GuardedAuthenticatedEntity extends BaseEntity implements AuthenticatableContract
{
    use AuthenticatableTrait;

    /**
     * @throws BindingResolutionException
     */
    protected static function booted(): void
    {
        $scope = app()->make(GuardQueryScope::class);
        static::addGlobalScope($scope);
    }
}
