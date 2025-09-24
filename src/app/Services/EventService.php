<?php

namespace App\Services;

use App\Data\Dto\Requests\EventCelebrant\PairCelebrantRequestDto;
use App\Data\Dto\Requests\EventCelebrant\SingleCelebrantRequestDto;
use App\Data\Dto\Requests\EventCreateRequestDto;
use App\Repositories\EventRepository\Data\EventCreateRepoData;
use App\Repositories\EventRepository\EventRepository;
use Exception;

readonly class EventService
{
    public function __construct(
        private EventRepository $eventRepository,
        private ClientService $clientService,
        private CelebrantService $celebrantService
    ) {}

    /**
     * @throws Exception
     */
    public function create(EventCreateRequestDto $request): void
    {
        $clientId = $this->clientService->create(
            $request->client
        );

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
            notes: $request->notes,
            clientId: $clientId,
            celebrantOne: $celebrantId,
            celebrantTwo: $celebrant2Id
        );
        $eventId = $this->eventRepository->create($eventRepoData);

        /**
         * Create mandatory schedules
         * call scheduleService
         */

        /**
         * Create RSVP
         * call rsvp service
         */
    }
}
