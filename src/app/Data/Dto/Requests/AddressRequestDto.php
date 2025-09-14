<?php
declare(strict_types=1);

namespace App\Data\Dto\Requests;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AddressRequestDto
{
    public function __construct(
        public ?UuidInterface $id = null,   // present => update existing
        public ?string $line1 = null,
        public ?string $line2 = null,
        public ?string $city  = null,
        public ?string $state = null,
        public ?string $zip   = null,
        public ?string $lat   = null,
        public ?string $long  = null,
        /** Tracks which keys the client actually sent (incl. null). */
        public array $provided = [],
    ) {}

    public static function rules(string $prefix = 'address'): array
    {
        return [
            $prefix => ['sometimes','array'],

            "{$prefix}.id"    => ['sometimes','uuid'],

            // If NO id -> require minimum fields to allow "create during update"
            "{$prefix}.line1" => ['sometimes','string','max:255',"required_without:{$prefix}.id"],
            "{$prefix}.city"  => ['sometimes','string','max:128',"required_without:{$prefix}.id"],
            "{$prefix}.state" => ['sometimes','string','max:128',"required_without:{$prefix}.id"],
            "{$prefix}.zip"   => ['sometimes','string','max:16', "required_without:{$prefix}.id"],

            "{$prefix}.line2" => ['sometimes','nullable','string','max:255'],

            // Geo pair: if one provided, require the other; allow null to clear
            "{$prefix}.lat"   => ['sometimes','nullable','numeric','between:-90,90',  "required_with:{$prefix}.long"],
            "{$prefix}.long"  => ['sometimes','nullable','numeric','between:-180,180',"required_with:{$prefix}.lat"],
        ];
    }

    public static function fromValidated(array $v, string $prefix = 'address'): ?self
    {
        if (!isset($v[$prefix])) {
            return null; // key absent => no change/creation
        }

        $a = $v[$prefix];
        $provided = array_keys($a); // what was sent (even if null)

        $get = fn(string $k) => array_key_exists($k, $a) ? $a[$k] : null;

        return new self(
            id:    array_key_exists('id', $a) ? Uuid::fromString($a['id']) : null,
            line1: $get('line1'),
            line2: $get('line2'),
            city:  $get('city'),
            state: $get('state'),
            zip:   $get('zip'),
            lat:   array_key_exists('lat',  $a) ? (isset($a['lat'])  ? (string)$a['lat']  : null) : null,
            long:  array_key_exists('long', $a) ? (isset($a['long']) ? (string)$a['long'] : null) : null,
            provided: $provided,
        );
    }

    public function provided(string $key): bool
    {
        return in_array($key, $this->provided, true);
    }
}
