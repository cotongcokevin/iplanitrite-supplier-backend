<?php

declare(strict_types=1);

namespace App\Console\Commands\Data;

use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\Type;
use UnhandledMatchError;

class GenerateModelColumn
{
    public function __construct(
        public string $namePlain,
        public string $nameDollar,
        public string $nameDollarThis,
        public string $nameSnake,
        public string $nameSnakeThis,
        public string $dataType
    ) {}

    public static function parseDataType(
        Type $columnType,
        bool $nullable
    ): string {
        try {
            $column = match (true) {
                $columnType instanceof DateTimeType => 'Carbon',
                $columnType instanceof DateType => 'Carbon',
                $columnType instanceof TextType => 'string',
                $columnType instanceof StringType => 'string',
                $columnType instanceof BigIntType => 'int',
                $columnType instanceof IntegerType => 'int',
                $columnType instanceof JsonType => '[convertMeToDto]',
                $columnType instanceof DecimalType => 'float',
                $columnType instanceof UuidType => 'UuidInterface',
                $columnType instanceof BooleanType => 'bool',
            };
        } catch (UnhandledMatchError $e) {
            dd($columnType);
        }

        return ($nullable ? '?' : '').$column;
    }
}
