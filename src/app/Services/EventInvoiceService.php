<?php

namespace App\Services;

use App\Enums\EventInvoiceStatus;
use App\Enums\EventStatus;
use App\Models\Client\ClientModel;
use App\Repositories\EventInvoiceRepository\EventInvoiceRepository;
use App\Repositories\EventInvoiceRepository\Data\EventInvoiceCreateRepoData;
use Ramsey\Uuid\UuidInterface;

readonly class EventInvoiceService
{

    public const INVOICE_SUFFIX = "INV";
    public const INVOICE_PADDING = 5;

    public function __construct(
        private EventInvoiceRepository $repository,
        private AddressService $addressService,
        private ContactNumberService $contactNumberService,
        private EventInvoiceItemService $eventInvoiceItemService,
    ) {}

    public function createInitialDeposit(
        UuidInterface $eventId,
        UuidInterface $eventCostId,
        ClientModel $client,
    ): void
    {
        $addressId = $this->addressService->duplicate($client->addressId);
        $contactId = $this->contactNumberService->duplicate($client->contactNumberId);

        $invoice = $this->repository->create(
            new EventInvoiceCreateRepoData(
                invoiceNumber: $this->getNextInvoiceNumber(),
                name: "$client->firstName $client->lastName",
                email: $client->email,
                eventId: $eventId,
                contactNumberId: $contactId,
                addressId: $addressId,
                status: EventInvoiceStatus::PENDING,
                clientId: $client->id,
            )
        );

        $this->eventInvoiceItemService->create(
            eventInvoiceId: $invoice->id,
            eventCostId: $eventCostId,
        );
    }

    private function getNextInvoiceNumber(): string {
        $totalInvoices = $this->repository->totalInvoice() + 1;
        return self::INVOICE_SUFFIX."-".str_pad($totalInvoices, self::INVOICE_PADDING, "0", STR_PAD_LEFT);
    }

}