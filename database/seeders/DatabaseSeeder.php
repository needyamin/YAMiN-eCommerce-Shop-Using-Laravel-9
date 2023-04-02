<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            "username" => "Md. Yamin Hossain",
            "mobile_no" => "01878578504",
            "email" => "admin@admin.com",
            "password" => Hash::make("admin@123"),
            "role" => "admin",

        ]);

    }
}
