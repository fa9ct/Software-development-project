<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::create([
            'name' => 'ali',
            'email' => 'ali2@gmail.com',
            'password' => bcrypt('123456789'),
            'phone_number' => '1434567890',
            'role' => 'admin',
        ]);
    }
}