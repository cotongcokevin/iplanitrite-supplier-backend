<?php

declare(strict_types=1);

namespace Tests\Integration;

abstract class ClientTestCase extends BaseTestCase
{
    public function getBaseUri(): string
    {
        return '/api/client';
    }

    public function getDefaultAuthEmail(): string
    {
        return 'asta.staria@client.com';
    }

    public function getDefaultAuthPassword(): string
    {
        return 'password';
    }
}
