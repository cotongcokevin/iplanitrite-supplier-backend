<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->toDateTimeString();

        Admin::firstOrCreate(
            attributes: ['email' => 'kevin@cotongco.com'],
            values: [
                'id' => Str::uuid()->toString(),
                'email' => 'kevin@cotongco.com',
                'password' => bcrypt('password'),
                'first_name' => "Kevin",
                'last_name' => "Cotongco",
                'created_at' => $date,
                'updated_at' => $date,
            ]
        );
    }
}
