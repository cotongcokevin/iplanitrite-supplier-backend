<?php

declare(strict_types=1);

namespace App\Models\Client\Context;

use App\Dto\Response\ClientContextDto;
use App\Models\ContactNumber\ContactNumberModel;
use BackedEnum;

readonly class ClientContext
{
    public function __construct(
        private ?ContactNumberModel $contactNumber,
    ) {}

    /**
     * @param  BackedEnum[]  $expectedContexts
     */
    public function toDto(array $expectedContexts): ClientContextDto
    {
        $result = new ClientContextDto(
            $this->contactNumber?->toDto(),
        );

        $result->setExpectedContexts($expectedContexts);

        return $result;
    }
}
