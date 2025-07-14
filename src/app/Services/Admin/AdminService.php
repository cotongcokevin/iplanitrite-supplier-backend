<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Classes\Principals\Principal;
use App\Dto\Requests\Admin\AdminStoreRequestDto;
use App\Dto\Requests\Admin\AdminUpdateRequestDto;
use App\Models\Admin\AdminModelData;
use App\Repositories\AdminRepository\AdminRepository;
use App\Repositories\AdminRepository\Data\AdminRepositoryStoreData;
use App\Repositories\AdminRepository\Data\AdminRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;

readonly class AdminService
{
    public function __construct(
        private AdminRepository $adminRepo,
        private Principal $principal,
        private UuidFactory $uuid
    ) {}

    /**
     * @return Collection<int, AdminModelData>
     */
    public function search(): Collection
    {
        return $this->adminRepo->search();
    }

    public function getById(UuidInterface $id): AdminModelData
    {
        return $this->adminRepo->getById($id);
    }

    public function store(AdminStoreRequestDto $dto): AdminModelData
    {
        $repoDto = new AdminRepositoryStoreData(
            $this->uuid->uuid4(),
            email: $dto->email,
            password: bcrypt($dto->password),
            firstName: $dto->firstName,
            lastName: $dto->lastName
        );

        return $this->adminRepo->store(
            $repoDto,
            $this->principal::get()
        );
    }

    public function update(
        AdminUpdateRequestDto $dto,
        UuidInterface $id
    ): AdminModelData {
        $repoDto = new AdminRepositoryUpdateData(
            email: $dto->email,
            password: $dto->password ? bcrypt($dto->password) : null,
            firstName: $dto->firstName,
            lastName: $dto->lastName
        );

        return $this->adminRepo->update(
            $repoDto,
            $id,
            $this->principal::get()
        );
    }

    public function destroy(UuidInterface $id): void
    {
        $this->adminRepo->destroy($id);
    }
}
