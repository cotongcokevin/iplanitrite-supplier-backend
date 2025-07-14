<?php

declare(strict_types=1);

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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

    public function toModel(): AddressModel
    {
        return new AddressModel(
            id: Uuid::fromString($this->id),
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
