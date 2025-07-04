<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{

    use SoftDeletes;

    /**
     * $keyType is the type of the id of the table which is UUID
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Increment is false as we're using UUID
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'admin';

    /**
     * @return string
     */
    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

}
