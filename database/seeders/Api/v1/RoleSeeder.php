<?php

namespace Database\Seeders\Api\v1;

use App\Models\Api\v1\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'superadmin'],
            ['name' => 'owner'],
            ['name' => 'cashier',],
            ['name' => 'manager',],

        ]);
    }
}
