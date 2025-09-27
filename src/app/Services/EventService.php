<?php

namespace App\Services;

use App\Data\Dto\Requests\EventCelebrant\PairCelebrantRequestDto;
use App\Data\Dto\Requests\EventCelebrant\SingleCelebrantRequestDto;
use App\Data\Dto\Requests\EventCreateRequestDto;
use App\Enums\EventStatus;
use App\Mail\OnEventCreated;
use App\Repositories\EventRepository\Data\EventCreateRepoData;
use App\Repositories\EventRepository\EventRepository;
use Exception;
use Illuminate\Support\Facades\Mail;

readonly class EventService
{
    public function __construct(
        private EventRepository $eventRepository,
        private ClientService $clientService,
        private CelebrantService $celebrantService,
        private ScheduleService $scheduleService
    ) {}

    /**
     * @throws Exception
     */
    public function create(EventCreateRequestDto $request): void
    {
        $client = $this->clientService->getByEmail($request->client->email);
        if (! $client) {
            $client = $this->clientService->create(
                $request->client
            );
        }

        $celebrantDto = $request->celebrant;
        switch ($celebrantDto::class) {
            case SingleCelebrantRequestDto::class:
                /** @var SingleCelebrantRequestDto $celebrantDto */
                $celebrantId = $this->celebrantService->create($celebrantDto->data);
                $celebrant2Id = null;
                break;
            case PairCelebrantRequestDto::class:
                /** @var PairCelebrantRequestDto $celebrantDto */
                $celebrantId = $this->celebrantService->create($celebrantDto->first);
                $celebrant2Id = $this->celebrantService->create($celebrantDto->second);
                break;
            default:
                throw new Exception('Invalid Celebrant Request');
        }

        $eventRepoData = new EventCreateRepoData(
            name: $request->name,
            type: $request->type,
            status: EventStatus::PENDING,
            notes: $request->notes,
            clientId: $client->id,
            celebrantOne: $celebrantId,
            celebrantTwo: $celebrant2Id
        );

        $event = $this->eventRepository->create($eventRepoData);

        Mail::to($request->client->email)
            ->queue(new OnEventCreated);

        $this->scheduleService->createMandatoryEventSchedule(
            $event,
            $request->schedule
        );
    }
}
