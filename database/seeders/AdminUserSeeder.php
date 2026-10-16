<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'name' => 'Dashboard Admin',
                'email' => 'admin@logic-consulting.com',
                'password' => Hash::make('admin@12345'),
                'role' => 'admin',
            ]
        );
    }
}