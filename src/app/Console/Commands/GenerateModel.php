<?php

namespace App\Console\Commands;

use App\Console\Commands\Data\GenerateModelColumn;
use App\Console\Commands\Data\UuidType;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\NoReturn;

class GenerateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-model {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws Exception
     */
    #[NoReturn] public function handle()
    {
        $modelName = $this->argument("modelName");
        $table = Str::snake($modelName);

        $connectionParams = [
            'dbname' => env("DB_DATABASE"),
            'user' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'host' => env("DB_HOST"),
            'driver' => 'pdo_pgsql',
        ];

        $conn = DriverManager::getConnection($connectionParams, new Configuration());
        if (!Type::hasType(UuidType::UUID)) {
            Type::addType(UuidType::UUID, UuidType::class);
        }
        $conn->getDatabasePlatform()->registerDoctrineTypeMapping('uuid', UuidType::UUID);
        $schemaManager = $conn->createSchemaManager();

        $columns = [];
        $result = $schemaManager->listTableColumns($table);
        foreach($result as $column) {
            $columns[] = new GenerateModelColumn(
                namePlain: Str::camel($column->getName()),
                nameDollar: '$'.Str::camel($column->getName()),
                nameDollarThis: '$this->'.Str::camel($column->getName()),
                dataType: GenerateModelColumn::parseDataType(
                    $column->getType(),
                    !$column->getNotnull()
                )
            );
        }

        $this->generateModelData(
            $modelName,
            $columns
        );

        $this->generateDto(
            $modelName,
            $columns
        );

        $this->generateModel(
            $table,
            $columns,
            $modelName,
        );

        $this->generateRepository(
            $modelName,
        );
    }

    /**
     * @param string $modelName
     * @param GenerateModelColumn[] $columns
     * @return void
     */
    #[NoReturn] private function generateModelData(
        string $modelName,
        array $columns
    ): void
    {
        $modelData = $modelName."Data";
        $modelNamespace = 'App\Models\\'.$modelName;
        $dto = $modelName."Dto";
        $dtoNamespace = "App\Dto\Response\\".$dto;
        $attributes = collect($columns)->map(fn(GenerateModelColumn $col) =>
            "        public {$col->dataType} {$col->nameDollar},"
        )->join("\n");

        $dtoArgs = collect($columns)->map(fn(GenerateModelColumn $col) =>
            "            {$col->namePlain}: {$col->nameDollarThis},"
        )->join("\n");

        $content = <<<PHP
<?php

declare(strict_types=1);

namespace $modelNamespace;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;
use $dtoNamespace;

class $modelData
{

    public function __construct(
{$attributes}
    ) { }


    public function toDto(): $dto {
        return new $dto(
{$dtoArgs}
        );
    }
}

PHP;
        $filePath = app_path("Models/{$modelName}/{$modelData}.php");
        $this->createFile($filePath, $content);
    }

    /**
     * @param string $modelName
     * @param GenerateModelColumn[] $columns
     */
    #[NoReturn] public function generateDto(
        string $modelName,
        array $columns
    ) {
        $dto = $modelName."Dto";
        $attributes = collect($columns)->map(fn(GenerateModelColumn $col) =>
        "        public {$col->dataType} {$col->nameDollar},"
        )->join("\n");

        $content = <<<PHP
<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Carbon\Carbon;
use Ramsey\Uuid\UuidInterface;

class $dto
{
    public function __construct(
$attributes
    ) {}
}

PHP;

        $filePath = app_path("Dto/Response/{$dto}.php");
        $this->createFile($filePath, $content);
    }

    /**
     * @param string $table
     * @param GenerateModelColumn[] $columns
     * @param string $modelName
     * @return void
     */
    public function generateModel(
        string $table,
        array $columns,
        string $modelName
    ): void {

        $namespace = "App\Models\\".$modelName;

        $modelData = $modelName."Data";
        $useModelData = "App\Models\\".$modelName."\\".$modelData;


        $args = collect($columns)->map(function(GenerateModelColumn $col) {
            $label = $col->nameDollarThis;
            if($col->dataType === "Carbon") {
                $label = "Carbon::parse($col->nameDollarThis)";
            }
            else if($col->dataType === "?Carbon") {
                $label = "$col->nameDollarThis ? Carbon::parse($col->nameDollarThis) : null";
            }
            else if($col->dataType === "UUID") {
                $label = "UuidInterface::fromString($col->nameDollarThis)";
            }
            else if($col->dataType === "?UUID") {
                $label = "$col->nameDollarThis ? UuidInterface::fromString($col->nameDollarThis) : null";
            }
            return "            {$col->namePlain}: {$label},";
        })->join("\n");
        $content = <<<PHP
<?php

declare(strict_types=1);

namespace $namespace;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidFactory;
use $useModelData;

class $modelName extends Model
{
    
    /**
     * @var string 
     */
    protected \$table = "$table";
    
    public function toModelData(): $modelData
    {
        return new $modelData(
$args
        );
    }

}

PHP;

        $filePath = app_path("Models/{$modelName}/{$modelName}.php");
        $this->createFile($filePath, $content);
    }

    public function generateRepository(
        string $modelName
    ): void {

        $repositoryName = $modelName."Repository";
        $namespace = "App\Repositories\\".$repositoryName;
        $content = <<<PHP
<?php

declare(strict_types=1);

namespace $namespace;

use App\Classes\Accountable;
use Ramsey\Uuid\UuidFactory;

class $repositoryName
{
    private Accountable \$accountable;

    private UuidFactory \$uuid;

    public function __construct(
        Accountable \$accountable,
        UuidFactory \$uuid
    ) {
        \$this->accountable = \$accountable;
        \$this->uuid = \$uuid;
    }
    
}


PHP;

        $filePath = app_path("Repositories/{$repositoryName}/{$repositoryName}.php");
        $this->createFile($filePath, $content);
    }

    public function createFile(string $filePath, string $content): void
    {
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true); // ✅ auto-create nested directory
        }
        if (file_exists($filePath)) {
            $this->info("SKIPPING $filePath, already exists");
        }

        file_put_contents($filePath, $content);
    }

}