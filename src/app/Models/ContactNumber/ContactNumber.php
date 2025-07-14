<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ContactNumber extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'contact_number';

    public function toModelData(): ContactNumberModelData
    {
        return new ContactNumberModelData(
            id: Uuid::fromString($this->id),
            number: $this->number,
        );
    }
}
