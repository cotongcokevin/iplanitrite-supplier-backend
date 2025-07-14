<?php

declare(strict_types=1);

namespace App\Repositories\AdminRepository;

use App\Classes\Principals\PrincipalData;
use App\Models\Admin\Admin;
use App\Models\Admin\AdminModelData;
use App\Repositories\AdminRepository\Data\AdminRepositoryStoreData;
use App\Repositories\AdminRepository\Data\AdminRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

readonly class AdminRepository
{
    /**
     * @return Collection<int, AdminModelData>
     */
    public function search(): Collection
    {
        $admins = Admin::get();

        return $admins->map(function (Admin $admin) {
            return $admin->toModelData();
        });
    }

    public function getById(UuidInterface $uuid): AdminModelData
    {
        $admin = Admin::find($uuid->toString());

        return $admin->toModelData();
    }

    public function store(
        AdminRepositoryStoreData $dto,
        PrincipalData $principal
    ): AdminModelData {
        $admin = new Admin;
        $admin->id = $dto->id;
        $admin->email = $dto->email;
        $admin->password = $dto->password;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->created_by = $principal->id;
        $admin->updated_by = $principal->id;
        $admin->save();

        return $admin->toModelData();
    }

    public function update(
        AdminRepositoryUpdateData $dto,
        UuidInterface $id,
        PrincipalData $principal
    ): AdminModelData {
        $admin = Admin::find($id->toString());
        $admin->email = $dto->email;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->updated_by = $principal->id;

        if ($dto->password !== null) {
            $admin->password = $dto->password;
        }

        $admin->save();

        return $admin->toModelData();
    }

    public function destroy(UuidInterface $id): void
    {
        Admin::find($id)
            ->delete();
    }
}
