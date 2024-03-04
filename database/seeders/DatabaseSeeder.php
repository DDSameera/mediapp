<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Database\Seeders\Api\v1\CustomerSeeder;
use Database\Seeders\Api\v1\MedicineSeeder;
use Database\Seeders\Api\v1\RoleSeeder;
use Database\Seeders\Api\v1\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            MedicineSeeder::class,

        ]);
    }
}
