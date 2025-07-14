<?php

declare(strict_types=1);

namespace App\Classes\Scopes\Guard;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GuardedAuthenticatedModel extends Authenticatable
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
