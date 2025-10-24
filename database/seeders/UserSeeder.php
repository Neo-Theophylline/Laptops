<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@lo.co',
            'password' => Hash::make('1234'),
            'role' => 'Admin',
            'status' => 'Active',
        ]);
        // technician
        // User::create([
        //     'name' => 'Technician',
        //     'email' => 'technician@lo.co',
        //     'password' => Hash::make('1234'),
        //     'role' => 'technician',
        //     'status' => 'Active',
        // ]);
        // customer
        // User::create([
        //     'name' => 'Customer',
        //     'email' => 'customer@lo.co',
        //     'password' => Hash::make('1234'),
        //     'role' => 'customer',
        //     'status' => 'Active',
        // ]);
    }
}
