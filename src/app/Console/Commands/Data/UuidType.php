<?php

declare(strict_types=1);

namespace App\Console\Commands\Data;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class UuidType extends Type
{
    public const UUID = 'uuid'; // Custom type name

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        // Tell Doctrine to use the native 'UUID' column type in PostgreSQL
        return 'UUID';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?string
    {
        // Return as string (or wrap in a UUID object if you want)
        return $value !== null ? (string) $value : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        // Accept string or null
        return $value !== null ? (string) $value : null;
    }

    public function getName()
    {
        return self::UUID;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): true
    {
        // Needed so Doctrine doesn't confuse this type on schema diff
        return true;
    }
}
