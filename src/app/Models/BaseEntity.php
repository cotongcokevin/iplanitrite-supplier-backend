<?php

declare(strict_types=1);

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseEntity extends Model
{
    /**
     * @throws Exception
     */
    public function validatedContexts(array $contexts): void
    {
        foreach ($contexts as $context) {
            if (! $this->relationLoaded($context->value)) {
                throw new Exception("Relationship $context->value not loaded");
            }
        }
    }
}
