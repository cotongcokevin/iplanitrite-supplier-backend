<?php

declare(strict_types=1);

namespace App\Models\Client;

use App\Classes\Casts\CarbonCast;
use App\Classes\Casts\UuidCast;
use App\Classes\Principals\PrincipalData;
use App\Enums\AuthGuardType;
use App\Models\Client\Context\ClientContext;
use App\Models\Client\Context\ClientContextException;
use App\Models\Client\Context\ClientContextType;
use App\Models\ContactNumber\ContactNumberEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\UuidInterface;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ClientEntity extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'client';

    /**
     * @var string
     */
    protected $keyType = 'string';

    public function getJWTIdentifier(): UuidInterface
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    protected $casts = [
        'id' => UuidCast::class,
        'contact_number_id' => UuidCast::class,
        'created_at' => CarbonCast::class,
        'updated_at' => CarbonCast::class,
        'deleted_at' => CarbonCast::class,
    ];

    public function toModel(): ClientModel
    {
        return new ClientModel(
            id: $this->id,
            email: $this->email,
            password: $this->password,
            firstName: $this->first_name,
            lastName: $this->last_name,
            contactNumberId: $this->contact_number_id,
            createdAt: $this->created_at,
            updatedAt: $this->updated_at,
            deletedAt: $this->deleted_at,
        );
    }

    public function toPrincipalData(): PrincipalData
    {
        return new PrincipalData(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            type: AuthGuardType::CLIENT,
            guardId: $this->id
        );
    }

    /**
     * @throws ClientContextException
     */
    public function buildContext($contexts): ClientContext
    {
        $contactNumberContext = null;
        foreach ($contexts as $context) {
            switch ($context) {
                case ClientContextType::CONTACT_NUMBER:
                    /** @var ContactNumberEntity $contactNumber */
                    $contactNumber = $this->contactNumber;
                    $contactNumberContext = $contactNumber->toModel();
                    break;
                default:
                    throw new ClientContextException("Invalid context $context");
            }
        }

        return new ClientContext(
            contactNumber: $contactNumberContext
        );
    }

    public function contactNumber(): BelongsTo
    {
        return $this->belongsTo(ContactNumberEntity::class, 'contact_number_id');
    }
}
