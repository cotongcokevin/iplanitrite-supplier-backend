<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

/** @var Application $app */
$kernel = $app->make(Kernel::class);

// Run migrations once
$kernel->call('migrate:fresh');

$dateToday = Carbon::now()->toArray();
Admin::create([
    "id" => '00000000-0000-0000-000000000001',
    'email' => 'admin@ems.com',
    'password' => bcrypt("password"),
    'first_name' => "Foo",
    'last_name' => "Bar",
    'created_at' => $dateToday,
    'updated_at' => $dateToday,
    'created_by' => null,
    'updated_by' => null,
]);