<?php

declare(strict_types=1);

namespace Tests\Integration;

abstract class AdminTestCase extends BaseTestCase
{
    public function getBaseUri(): string
    {
        return '/api';
    }

    public function getDefaultAuthEmail(): string
    {
        return '';
    }

    public function getDefaultAuthPassword(): string
    {
        return '';
    }
}
