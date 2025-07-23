<?php

declare(strict_types=1);

namespace App\Models\EventSpecificTemplate;

use App\Data\Dto\Response\EventSpecificTemplateDto;
use App\Data\Udf\UdfTemplate;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSpecificTemplateModel
{
    /**
     * @param  UdfTemplate[]  $udf
     */
    public function __construct(
        public UuidInterface $id,
        public string $eventType,
        public UuidInterface $supplierId,
        public array $udf,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}

    public function toDto(): EventSpecificTemplateDto
    {
        return new EventSpecificTemplateDto(
            id: $this->id,
            eventType: $this->eventType,
            supplierId: $this->supplierId,
            udf: $this->udf,
            createdBy: $this->createdBy,
            updatedBy: $this->updatedBy,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt,
        );
    }
}
