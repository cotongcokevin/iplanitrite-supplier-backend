<?php

declare(strict_types=1);

namespace App\Models;

use App\Classes\Scopes\Guard\GuardQueryScope;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GuardedAuthenticatedEntity extends Authenticatable
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
