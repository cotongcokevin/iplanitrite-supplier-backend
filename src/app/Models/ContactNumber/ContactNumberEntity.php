<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use App\Classes\Casts\UuidCast;
use App\Models\BaseEntity;

class ContactNumberEntity extends BaseEntity
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

    protected $casts = [
        'id' => UuidCast::class];

    public function toModel(): ContactNumberModel
    {
        return new ContactNumberModel(
            id: $this->id,
            number: $this->number,
        );
    }
}
