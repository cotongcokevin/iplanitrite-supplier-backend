<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ContactNumberEntity extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string
     */
    protected $table = 'contact_number';

    public function toModel(): ContactNumberModel
    {
        return new ContactNumberModel(
            id: Uuid::fromString($this->id),
            number: $this->number,
        );
    }
}
