<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Requests\AdminStoreRequestDto;
use App\Dto\Requests\AdminUpdateRequestDto;
use App\Models\Admin\AdminEntity;
use App\Repositories\AdminRepository\AdminRepository;
use App\Repositories\AdminRepository\Models\AdminRepositoryStoreModel;
use App\Repositories\AdminRepository\Models\AdminRepositoryUpdateModel;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

readonly class AdminService
{

    /**
     * @param AdminRepository $adminRepo
     */
    public function __construct(private AdminRepository $adminRepo) { }

    /**
     * @return Collection<int, AdminEntity>
     */
    public function search(): Collection
    {
        return $this->adminRepo->search();
    }

    /**
     * @param UuidInterface $id
     * @return AdminEntity
     */
    public function getById(UuidInterface $id): AdminEntity
    {
        return $this->adminRepo->getById($id);
    }

    /**
     * @param AdminStoreRequestDto $dto
     * @return AdminEntity
     */
    public function store(AdminStoreRequestDto $dto): AdminEntity
    {
        $repoDto = new AdminRepositoryStoreModel(
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
     * @return AdminEntity
     */
    public function update(
        AdminUpdateRequestDto $dto,
        UuidInterface        $id
    ): AdminEntity
    {
        $repoDto = new AdminRepositoryUpdateModel(
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