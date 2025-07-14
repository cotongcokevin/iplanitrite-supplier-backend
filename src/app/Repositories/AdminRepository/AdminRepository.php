<?php

declare(strict_types=1);

namespace App\Repositories\AdminRepository;

use App\Classes\Principals\PrincipalData;
use App\Models\Admin\AdminEntity;
use App\Models\Admin\AdminModel;
use App\Repositories\AdminRepository\Data\AdminRepositoryStoreData;
use App\Repositories\AdminRepository\Data\AdminRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

readonly class AdminRepository
{
    /**
     * @return Collection<int, AdminModel>
     */
    public function search(): Collection
    {
        $admins = AdminEntity::get();

        return $admins->map(function (AdminEntity $admin) {
            return $admin->toModel();
        });
    }

    public function getById(UuidInterface $uuid): AdminModel
    {
        /** @var AdminEntity $admin */
        $admin = AdminEntity::find($uuid->toString());

        return $admin->toModel();
    }

    public function store(
        AdminRepositoryStoreData $dto,
        PrincipalData $principal
    ): AdminModel {
        $admin = new AdminEntity;
        $admin->id = $dto->id;
        $admin->email = $dto->email;
        $admin->password = $dto->password;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->created_by = $principal->id;
        $admin->updated_by = $principal->id;
        $admin->save();

        return $admin->toModel();
    }

    public function update(
        AdminRepositoryUpdateData $dto,
        UuidInterface $id,
        PrincipalData $principal
    ): AdminModel {
        /** @var AdminEntity $admin */
        $admin = AdminEntity::find($id->toString());
        $admin->email = $dto->email;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->updated_by = $principal->id;

        if ($dto->password !== null) {
            $admin->password = $dto->password;
        }

        $admin->save();

        return $admin->toModel();
    }

    public function destroy(UuidInterface $id): void
    {
        AdminEntity::find($id)
            ->delete();
    }
}
