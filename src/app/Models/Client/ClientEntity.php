<?php

declare(strict_types=1);

namespace App\Models\Client;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientEntity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'client';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
        'contact_number_id' => UuidCast::class,
        'address_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): ClientModel
    {
        return new ClientModel(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            email: $this->email,
            password: $this->password,
            contactNumberId: $this->contact_number_id,
            addressId: $this->address_id,
            createdBy: $this->created_by,
            updatedBy: $this->updated_by,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }
}
