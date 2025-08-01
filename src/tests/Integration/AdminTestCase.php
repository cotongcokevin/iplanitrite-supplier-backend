<?php

declare(strict_types=1);

namespace Tests\Integration;

abstract class AdminTestCase extends BaseTestCase
{
    public function getBaseUri(): string
    {
        return '/api/admin';
    }

    public function getDefaultAuthEmail(): string
    {
        return 'cotongcokevin@iplanitrite.com';
    }

    public function getDefaultAuthPassword(): string
    {
        return 'password';
    }
}
