<?php

declare(strict_types=1);

namespace App\Models\Celebrant;

use App\Classes\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;

class CelebrantEntity extends Model
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'celebrant';

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $casts = [
        'id' => UuidCast::class,
    ];

    public function toModel(): CelebrantModel
    {
        return new CelebrantModel(
            id: $this->id,
            title: $this->title,
            name: $this->name,
        );
    }
}
