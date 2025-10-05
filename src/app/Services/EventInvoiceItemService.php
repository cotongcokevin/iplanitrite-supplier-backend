<?php

namespace App\Services;

use App\Models\EventInvoiceItem\EventInvoiceItemModel;
use App\Repositories\EventInvoiceItemRepository\EventInvoiceItemRepository;
use Ramsey\Uuid\UuidInterface;

readonly class EventInvoiceItemService
{
    public function __construct(
        private EventInvoiceItemRepository $repository,
    ) {}

    public function create(
        UuidInterface $eventInvoiceId,
        UuidInterface $eventCostId
    ): EventInvoiceItemModel {
        return $this->repository->create(
            eventInvoiceId: $eventInvoiceId,
            eventCostId: $eventCostId,
        );
    }
}
