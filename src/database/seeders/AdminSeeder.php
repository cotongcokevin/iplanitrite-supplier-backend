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
            attributes: ['email' => 'admin@ems.com'],
            values: [
                'id' => Str::uuid()->toString(),
                'email' => 'admin@ems.com',
                'password' => bcrypt('password'),
                'first_name' => "Naruto",
                'last_name' => "Uzumaki",
                'created_at' => $date,
                'updated_at' => $date,
            ]
        );
    }
}
