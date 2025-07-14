<?php

declare(strict_types=1);

namespace App\Repositories\AdminRepository;

use App\Classes\Principals\AdminPrincipal;
use App\Models\Admin\Admin;
use App\Models\Admin\AdminModelData;
use App\Repositories\AdminRepository\Data\AdminRepositoryStoreData;
use App\Repositories\AdminRepository\Data\AdminRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

readonly class AdminRepository
{
    public function __construct(
        private AdminPrincipal $principal,
    ) {}

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

    public function store(AdminRepositoryStoreData $dto): AdminModelData
    {
        $principalId = $this->principal->get()->id;

        $admin = new Admin;
        $admin->id = $dto->id;
        $admin->email = $dto->email;
        $admin->password = $dto->password;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->created_by = $principalId;
        $admin->updated_by = $principalId;
        $admin->save();

        return $admin->toModelData();
    }

    public function update(
        AdminRepositoryUpdateData $dto,
        UuidInterface $id
    ): AdminModelData {
        $admin = Admin::find($id->toString());
        $admin->email = $dto->email;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->updated_by = $this->principal->get()->id;

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
