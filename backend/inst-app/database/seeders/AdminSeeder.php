<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin',
            'last_name' => 'Lexem',
            'email' => 'admin@lexem.sk',
            'password' => Hash::make('admin123'),
            'position' => 'Manager',
        ]);
    }
}
