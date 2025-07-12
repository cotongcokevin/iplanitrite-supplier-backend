<?php

declare(strict_types=1);

namespace Tests\Integration;

abstract class OrganizerTestCase extends \Tests\Integration\BaseTestCase
{
    public function getBaseUri(): string
    {
        return '/api/organizer';
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
