<?php

declare(strict_types=1);

namespace App\Classes\Scopes\Guard;

use App\Classes\Principals\Principal;
use App\Classes\Principals\PrincipalException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

readonly class GuardQueryScope implements Scope
{
    public function __construct(private Principal $principal) {}

    public function apply(
        Builder $builder,
        Model $model
    ): void {
        try {
            $principal = $this->principal::get();
        } catch (PrincipalException $e) {
            return;
        }

        $column = 'supplier_id';
        $builder->where($model->getTable().'.'.$column, $principal->guardId);
    }
}
