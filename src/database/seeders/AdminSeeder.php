<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
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

        Admin::create([
            'id' => "d611fad5-e65e-4afb-a201-bc3dad9f1e7d",
            'email' => 'naruto.uzumaki@ems.com',
            'password' => bcrypt('password'),
            'first_name' => "Naruto",
            'last_name' => "Uzumaki",
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        Admin::find("d611fad5-e65e-4afb-a201-bc3dad9f1e7d")
            ->update([
                "created_by" => "d611fad5-e65e-4afb-a201-bc3dad9f1e7d",
                "updated_by" => "d611fad5-e65e-4afb-a201-bc3dad9f1e7d"
            ]);

        Admin::create([
            'id' => "8dd17f21-524d-4ad9-8604-b7afe060fe3d",
            'email' => 'sasuke.uchiha@ems.com',
            'password' => bcrypt('password'),
            'first_name' => "Sasuke",
            'last_name' => "Uchiha",
            'created_at' => $date,
            'updated_at' => $date,
            "created_by" => "d611fad5-e65e-4afb-a201-bc3dad9f1e7d",
            "updated_by" => "d611fad5-e65e-4afb-a201-bc3dad9f1e7d"
        ]);
    }
}
