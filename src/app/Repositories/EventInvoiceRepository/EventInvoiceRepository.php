<?php

declare(strict_types=1);

namespace App\Repositories\EventInvoiceRepository;

use App\Classes\Principals\Principal;
use App\Models\EventInvoice\EventInvoiceEntity;
use App\Models\EventInvoice\EventInvoiceModel;
use App\Repositories\EventInvoiceRepository\Data\EventInvoiceCreateRepoData;
use Ramsey\Uuid\Uuid;

readonly class EventInvoiceRepository
{
    public function __construct(
        private Principal $principal,
    ) {}

    public function totalInvoice(): int
    {
        return EventInvoiceEntity::withTrashed()->count();
    }

    public function create(EventInvoiceCreateRepoData $data): EventInvoiceModel
    {
        $principal = $this->principal::get();

        $invoice = new EventInvoiceEntity;
        $invoice->id = Uuid::uuid4();
        $invoice->invoice_number = $data->invoiceNumber;
        $invoice->name = $data->name;
        $invoice->email = $data->email;
        $invoice->contact_number_id = $data->contactNumberId;
        $invoice->event_id = $data->eventId;
        $invoice->address_id = $data->addressId;
        $invoice->status = $data->status->value;
        $invoice->client_id = $data->clientId;
        $invoice->supplier_id = $principal->guardId;
        $invoice->save();

        return $invoice->toModel();
    }
}
