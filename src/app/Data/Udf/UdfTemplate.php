<?php

declare(strict_types=1);

namespace App\Data\Udf;

use App\Enums\UserDefinedFieldType;

class UdfTemplate
{
    public function __construct(
        public string $name,
        public UserDefinedFieldType $type,
        public bool $required
    ) {}

    /**
     * @return UdfTemplate[]
     */
    public static function fromString(string $udf): array
    {
        return array_map(
            fn ($data) => (
                new UdfTemplate(
                    name: $data->name,
                    type: $data->type,
                    required: $data->required
                )
            ),
            json_decode($udf)
        );
    }
}
