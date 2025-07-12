<?php

declare(strict_types=1);

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'address';

    public function toModelData(): AddressData
    {
        return new AddressData(
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
