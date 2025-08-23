<?php

declare(strict_types=1);

namespace App\Classes\Scopes\Guard;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class GuardedEntity extends Model
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
