<?php

namespace Database\Seeders\Api\v1;

use App\Models\Api\v1\Medicine;

use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicine::factory()->count(10)->create();
    }
}
