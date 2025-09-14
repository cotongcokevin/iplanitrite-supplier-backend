<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Dto\Requests\AddressRequestDto;
use App\Repositories\AddressRepository\AddressRepository;
use App\Repositories\AddressRepository\Data\AddressRepositoryUpsertRepoData;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;

readonly class AddressService
{
    public function __construct(
        private AddressRepository $addressRepository,
        private UuidFactory $uuid,
    ) {}

    public function upsert(
        AddressRequestDto $request,
        ?UuidInterface $uuid = null,
    ): UuidInterface {

        $addressId = $uuid ?? $this->uuid->uuid4();
        $this->addressRepository->upsert(new AddressRepositoryUpsertRepoData(
            $addressId,
            $request->line1,
            $request->line2,
            $request->city,
            $request->state,
            $request->zip,
            $request->lat,
            $request->long,
        ));

        return $addressId;

    }

    public function destroy(UuidInterface $id): void
    {
        $this->addressRepository->destroy($id);
    }
}
