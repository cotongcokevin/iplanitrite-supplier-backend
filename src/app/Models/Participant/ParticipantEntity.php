<?php

declare(strict_types=1);

namespace App\Models\Participant;

use App\Classes\Casts\UuidCast;
use App\Classes\Casts\CarbonCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticipantEntity extends Model
{  
    use SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'participant';
    
    /**
     * @var string
     */
    protected $keyType = 'string';
    
    protected $casts = [
        'id' => UuidCast::class,
        'date_of_birth' => CarbonCast::class,
        'contact_number_id' => UuidCast::class,
        'address_id' => UuidCast::class,
        'created_by' => UuidCast::class,
        'updated_by' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): ParticipantModel
    {
        return new ParticipantModel(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->first_name,
            lastName: $this->last_name,
            dateOfBirth: $this->date_of_birth,
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
