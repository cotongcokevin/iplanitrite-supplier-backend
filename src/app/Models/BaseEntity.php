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
