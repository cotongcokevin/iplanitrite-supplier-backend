<?php

declare(strict_types=1);

namespace App\Models\Supplier;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'supplier';

    public function toModelData(): SupplierData
    {
        return new SupplierData(
            id: $this->id,
            name: $this->name,
            description: $this->description,
            maxStaff: $this->maxStaff,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt ? Carbon::parse($this->createdAt) : null,
            updatedAt: $this->updatedAt ? Carbon::parse($this->updatedAt) : null,
            deletedAt: $this->deletedAt ? Carbon::parse($this->deletedAt) : null,
        );
    }
}
