<?php

declare(strict_types=1);

namespace App\Data\Dto\Response;

use App\Classes\Pair;
use App\Data\Dto\ResponseDto;
use App\Models\SupplierStaff\Context\SupplierStaffContext;
use App\Models\SupplierStaff\Context\SupplierStaffContextType;
use App\Models\SupplierStaff\SupplierStaffModel;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class SupplierStaffDto extends ResponseDto
{
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?Carbon $dateOfBirth,
        public UuidInterface $supplierId,
        public UuidInterface $supplierRoleId,
        public ?UuidInterface $createdBy,
        public ?UuidInterface $updatedBy,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?SupplierStaffContextDto $context = null
    ) {}

    /**
     * @param  Pair<SupplierStaffModel, SupplierStaffContext>  $supplierStaffWithContext
     * @param  SupplierStaffContextType[]  $expectedContexts
     */
    public static function buildFromContextPair(
        Pair $supplierStaffWithContext,
        array $expectedContexts,
    ): SupplierStaffDto {
        $supplierStaff = $supplierStaffWithContext->first;
        $context = $supplierStaffWithContext->second->toDto($expectedContexts);

        return new SupplierStaffDto(
            id: $supplierStaff->id,
            email: $supplierStaff->email,
            password: $supplierStaff->password,
            firstName: $supplierStaff->firstName,
            lastName: $supplierStaff->lastName,
            dateOfBirth: $supplierStaff->dateOfBirth,
            supplierId: $supplierStaff->supplierId,
            supplierRoleId: $supplierStaff->supplierRoleId,
            createdBy: $supplierStaff->createdBy,
            updatedBy: $supplierStaff->updatedBy,
            createdAt: $supplierStaff->createdAt,
            updatedAt: $supplierStaff->updatedAt,
            deletedAt: $supplierStaff->deletedAt,
            context: $context
        );
    }
}
