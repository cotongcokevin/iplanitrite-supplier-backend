<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Data\Dto\ResponseDto;
use App\Data\Udf\UdfTemplate;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class EventSpecificTemplateDto extends ResponseDto
{
    /**
     * @param  UdfTemplate[]  $udf
     */
    public function __construct(
        public UuidInterface $id,
        public string $eventType,
        public UuidInterface $supplierId,
        public ?array $udf,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {}
}
