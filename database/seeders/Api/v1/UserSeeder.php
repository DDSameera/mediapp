<?php

namespace Database\Seeders\Api\v1;

use App\Models\Api\v1\Role;
use App\Models\Api\v1\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Create predefined users
        User::create([
            'username' => 'superadmin',
            'password' => Hash::make('superadmin'),
            'role_id' =>  '1'
        ]);

        User::create([
            'username' => 'owner',
            'password' => Hash::make('owner'),
            'role_id' =>  '2'
        ]);

        User::create([
            'username' => 'cashier',
            'password' => Hash::make('cashier'),
            'role_id' =>  '3'
        ]);

        User::create([
            'username' => 'manager',
            'password' => Hash::make('manager'),
            'role_id' =>  '4'
        ]);
    }
}
