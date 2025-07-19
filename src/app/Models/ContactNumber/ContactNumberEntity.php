<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use App\Classes\Cast\UuidCast;
use Illuminate\Database\Eloquent\Model;

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
