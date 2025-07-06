<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Dto\Response\AdminDto;
use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class AdminModelData
{

    /**
     * @param UuidInterface $id
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param UuidInterface $createdBy
     * @param UuidInterface $updatedBy
     * @param Carbon $createdAt
     * @param Carbon $updatedAt
     * @param ?Carbon $deletedAt
     */
    public function __construct(
        public UuidInterface $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public UuidInterface $createdBy,
        public UuidInterface $updatedBy,
        public Carbon $createdAt,
        public Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) { }

    /**
     * @return AdminDto
     */
    public function toDto(): AdminDto {
        return new AdminDto(
            $this->id,
            $this->email,
            $this->firstName,
            $this->lastName,
            $this->createdBy,
            $this->updatedBy,
            $this->createdAt,
            $this->updatedAt,
            $this->deletedAt,
        );
    }

}