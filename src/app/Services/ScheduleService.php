<?php

namespace App\Services;

use App\Classes\Principals\Principal;
use App\Data\Dto\Requests\EventSchedule\EventScheduleRequest;
use App\Data\Dto\Requests\EventSchedule\EventScheduleRequestDto;
use App\Data\Dto\Requests\EventSchedule\PairScheduleRequestDto;
use App\Data\Dto\Requests\EventSchedule\SingleScheduleRequestDto;
use App\Data\Dto\Requests\ScheduleAppointeeRequestDto;
use App\Data\Dto\Requests\ScheduleCreateRequestDto;
use App\Enums\AppointeeType;
use App\Enums\EventType;
use App\Mail\OnScheduleAssigned;
use App\Models\Event\EventModel;
use App\Models\Schedule\ScheduleModel;
use App\Repositories\ScheduleRepository\Data\ScheduleCreateRepoData;
use App\Repositories\ScheduleRepository\ScheduleRepository;
use App\Repositories\SupplierStaffRepository\SupplierStaffRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

readonly class ScheduleService
{
    public function __construct(
        private ScheduleRepository $scheduleRepository,
        private ScheduleAppointeeService $scheduleAppointeeService,
        private ClientService $clientService,
        private SupplierStaffRepository $supplierStaffRepository,
        private AddressService $addressService,
        private RsvpService $rsvpService,
        private Principal $principal
    ) {}

    public function create(
        ScheduleCreateRequestDto $request,
        bool $isMandatory,
        bool $sendEmail = true
    ): ScheduleModel {
        $addressId = null;
        if ($request->address !== null) {
            $addressId = $this->addressService->upsert(
                $request->address,
                null
            );
        }

        $schedule = $this->scheduleRepository->create(
            new ScheduleCreateRepoData(
                title: $request->title,
                startDate: $request->startDate,
                endDate: $request->endDate,
                notes: $request->notes,
                isMandatory: $isMandatory,
                eventId: $request->eventId,
                addressId: $addressId
            )
        );

        foreach ($request->appointees as $appointee) {
            $this->scheduleAppointeeService->create(
                $appointee->id,
                $appointee->type,
                $schedule->id
            );
        }

        if ($sendEmail) {
            $groupedAppointees = collect($request->appointees)
                ->groupBy('type')
                ->map(fn ($items) => $items->pluck('id')->all())
                ->toArray();

            $staffIds = $groupedAppointees[AppointeeType::SUPPLIER_STAFF->value];
            $staffs = $this->supplierStaffRepository->getByIds($staffIds);
            foreach ($staffs as $staff) {
                Mail::to($staff->email)
                    ->queue(new OnScheduleAssigned(
                        $schedule,
                        "$staff->firstName $staff->lastName"
                    ));
            }

            $clientIds = $groupedAppointees[AppointeeType::CLIENT->value];
            $clients = $this->clientService->getByIds($clientIds);
            foreach ($clients as $client) {
                Mail::to($client->email)
                    ->queue(new OnScheduleAssigned(
                        $schedule,
                        "$client->firstName $client->lastName"
                    ));
            }
        }

        return $schedule;
    }

    /**
     * @throws Exception
     */
    public function createMandatoryEventSchedule(
        EventModel $event,
        EventScheduleRequest $scheduleRequest
    ): void {
        switch ($event->type) {
            case EventType::WEDDING:
                if (! $scheduleRequest instanceof PairScheduleRequestDto) {
                    throw new Exception('Wedding should have 2 default schedule requests.');
                }

                $this->createPairMandatoryEventSchedule(
                    $event,
                    $scheduleRequest,
                    'RECEPTION'
                );
                break;
            case EventType::BAPTISM:
            case EventType::ENGAGEMENT:
            case EventType::BRIDAL_SHOWER:
            case EventType::BABY_SHOWER:
            case EventType::DEBUT:
            case EventType::BIRTHDAY:
            case EventType::ANNIVERSARY:
            case EventType::ANNIVERSARY_COUPLE:
            case EventType::CORPORATE_EVENT:
                if (! $scheduleRequest instanceof SingleScheduleRequestDto) {
                    throw new Exception($event->type->value.' should only have 1 default schedule request.');
                }

                $this->createSingleMandatoryEventSchedule(
                    $event,
                    $scheduleRequest
                );
                break;
        }
    }

    private function createSingleMandatoryEventSchedule(
        EventModel $event,
        SingleScheduleRequestDto $scheduleRequest
    ): void {
        $request = ScheduleCreateRequestDto::fromRequest(new Request([
            'title' => $event->type->name,
            'startDate' => $scheduleRequest->data->date,
            'endDate' => $scheduleRequest->data->date,
            'notes' => null,
            'eventId' => $event->id,
            'address' => $scheduleRequest->data->address,
            'appointee' => $this->generateDefaultAppointee($event),
        ]));

        if ($scheduleRequest->data->guestsCount > 0) {
            $schedule = $this->create($request, true);
            $this->rsvpService->create(
                $schedule->id,
                $scheduleRequest->data->guestsCount
            );
        }
    }

    private function createPairMandatoryEventSchedule(
        EventModel $event,
        PairScheduleRequestDto $scheduleRequest,
        string $secondScheduleName
    ): void {
        /** @var EventScheduleRequestDto[] $requests */
        $requests = [$scheduleRequest->first, $scheduleRequest->second];
        foreach ($requests as $key => $request) {
            $createRequest = ScheduleCreateRequestDto::fromRequest(new Request([
                'title' => $key === 0 ? $event->type->name : $secondScheduleName,
                'startDate' => $request->date,
                'endDate' => $request->date,
                'notes' => null,
                'eventId' => $event->id,
                'address' => $request->address,
                'appointees' => $this->generateDefaultAppointee($event),
            ]));

            $schedule = $this->create($createRequest, true, $key === 0);

            if ($request->guestsCount > 0) {
                $this->rsvpService->create(
                    $schedule->id,
                    $request->guestsCount
                );
            }
        }
    }

    /**
     * @return ScheduleAppointeeRequestDto[]
     */
    private function generateDefaultAppointee(EventModel $event): array
    {
        return [
            [
                'id' => $this->principal::get()->id,
                'type' => AppointeeType::SUPPLIER_STAFF,
            ],
            [
                'id' => $event->clientId,
                'type' => AppointeeType::CLIENT,
            ],
        ];
    }
}
