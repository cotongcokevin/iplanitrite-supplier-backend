<?php

declare(strict_types=1);

namespace App\Models\Address;

use App\Classes\Cast\UuidCast;
use Illuminate\Database\Eloquent\Model;

class AddressEntity extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string
     */
    protected $table = 'address';

    protected $casts = [
        'id' => UuidCast::class,
    ];

    public function toModel(): AddressModel
    {
        return new AddressModel(
            id: $this->id,
            line1: $this->line1,
            line2: $this->line2,
            city: $this->city,
            state: $this->state,
            zip: $this->zip,
            lat: $this->lat,
            long: $this->long,
        );
    }
}
