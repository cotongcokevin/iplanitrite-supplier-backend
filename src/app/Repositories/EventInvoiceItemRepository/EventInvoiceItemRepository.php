<?php

declare(strict_types=1);

namespace App\Repositories\EventInvoiceItemRepository;

use App\Classes\Principals\Principal;
use App\Models\EventInvoiceItem\EventInvoiceItemEntity;
use App\Models\EventInvoiceItem\EventInvoiceItemModel;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class EventInvoiceItemRepository
{
    public function __construct(
        private Principal $principal,
    ) {}

    public function create(
        UuidInterface $eventInvoiceId,
        UuidInterface $eventCostId
    ): EventInvoiceItemModel {
        $principal = $this->principal::get();

        $invoiceItem = new EventInvoiceItemEntity();
        $invoiceItem->id = Uuid::uuid4();
        $invoiceItem->event_invoice_id = $eventInvoiceId;
        $invoiceItem->event_cost_id = $eventCostId;
        $invoiceItem->supplier_id = $principal->guardId;
        $invoiceItem->save();

        return $invoiceItem->toModel();
    }
}
