<?php

declare(strict_types=1);

namespace App\Classes;

use BackedEnum;
use JsonSerializable;

abstract class ContextDto implements JsonSerializable
{
    /**
     * @var BackedEnum[]
     */
    private array $expectedContexts;

    /**
     * @param  BackedEnum[]  $expectedContexts
     */
    public function setExpectedContexts(array $expectedContexts): void
    {
        $this->expectedContexts = array_map(
            function (BackedEnum $enum) {
                return $enum->value;
            },
            $expectedContexts
        );
    }

    public function jsonSerialize(): array
    {
        return collect(get_object_vars($this))
            ->only($this->expectedContexts)
            ->all();
    }
}
