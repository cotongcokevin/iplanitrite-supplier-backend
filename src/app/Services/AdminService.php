<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Requests\AdminStoreRequestDto;
use App\Dto\Requests\AdminUpdateRequestDto;
use App\Models\Admin\AdminModelData;
use App\Repositories\AdminRepository\AdminRepository;
use App\Repositories\AdminRepository\Data\AdminRepositoryStoreData;
use App\Repositories\AdminRepository\Data\AdminRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

readonly class AdminService
{

    /**
     * @param AdminRepository $adminRepo
     */
    public function __construct(private AdminRepository $adminRepo) { }

    /**
     * @return Collection<int, AdminModelData>
     */
    public function search(): Collection
    {
        return $this->adminRepo->search();
    }

    /**
     * @param UuidInterface $id
     * @return AdminModelData
     */
    public function getById(UuidInterface $id): AdminModelData
    {
        return $this->adminRepo->getById($id);
    }

    /**
     * @param AdminStoreRequestDto $dto
     * @return AdminModelData
     */
    public function store(AdminStoreRequestDto $dto): AdminModelData
    {
        $repoDto = new AdminRepositoryStoreData(
            email: $dto->email,
            password: bcrypt($dto->password),
            firstName: $dto->firstName,
            lastName: $dto->lastName
        );

        return $this->adminRepo->store($repoDto);
    }

    /**
     * @param AdminUpdateRequestDto $dto
     * @param UuidInterface $id
     * @return AdminModelData
     */
    public function update(
        AdminUpdateRequestDto $dto,
        UuidInterface        $id
    ): AdminModelData
    {
        $repoDto = new AdminRepositoryUpdateData(
            email: $dto->email,
            password: $dto->password ? bcrypt($dto->password) : null,
            firstName: $dto->firstName,
            lastName: $dto->lastName
        );

        return $this->adminRepo->update(
            $repoDto,
            $id
        );
    }

    /**
     * @param UuidInterface $id
     * @return void
     */
    public function destroy(UuidInterface $id): void
    {
        $this->adminRepo->destroy($id);
    }

}