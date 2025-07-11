<?php

declare(strict_types=1);

namespace App\Models\ContactNumber;

use Illuminate\Database\Eloquent\Model;

class ContactNumber extends Model
{
    protected string $guard = 'contact_number';

    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'contact_number';

    public function toModelData(): ContactNumberData
    {
        return new ContactNumberData;
    }
}
