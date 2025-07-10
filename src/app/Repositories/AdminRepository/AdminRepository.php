<?php

declare(strict_types=1);

namespace App\Repositories\AdminRepository;

use App\Classes\Accountable;
use App\Models\Admin\Admin;
use App\Models\Admin\AdminModelData;
use App\Repositories\AdminRepository\Data\AdminRepositoryStoreData;
use App\Repositories\AdminRepository\Data\AdminRepositoryUpdateData;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;

class AdminRepository
{
    private Accountable $accountable;

    private UuidFactory $uuid;

    public function __construct(
        Accountable $accountable,
        UuidFactory $uuid
    ) {
        $this->accountable = $accountable;
        $this->uuid = $uuid;
    }

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
        $accountableId = $this->accountable->get()->id;

        $admin = new Admin;
        $admin->id = $this->uuid->uuid4();
        $admin->email = $dto->email;
        $admin->password = $dto->password;
        $admin->first_name = $dto->firstName;
        $admin->last_name = $dto->lastName;
        $admin->created_by = $accountableId;
        $admin->updated_by = $accountableId;
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
        $admin->updated_by = $this->accountable->get()->id;

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
