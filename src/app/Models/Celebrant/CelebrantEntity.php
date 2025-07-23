<?php

declare(strict_types=1);

namespace App\Models\Celebrant;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CelebrantEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'celebrant';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'date_of_birth' => CarbonCast::class,
        'client_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): CelebrantModel
    {
        return new CelebrantModel(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            dateOfBirth: $this->date_of_birth,
            clientId: $this->client_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
