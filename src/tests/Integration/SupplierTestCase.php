<?php

declare(strict_types=1);

namespace Tests\Integration;

abstract class SupplierTestCase extends BaseTestCase
{
    public function getBaseUri(): string
    {
        return '/api/supplier';
    }

    public function getDefaultAuthEmail(): string
    {
        return 'luffy.monkey@ems.com';
    }

    public function getDefaultAuthPassword(): string
    {
        return 'password';
    }
}
