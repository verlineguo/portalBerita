<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => '2372901@maranatha.ac.id',
            'password' => Hash::make('12345678'), // Ganti dengan password yang lebih aman
            'role' => 0, // 0 = Admin
        ]);
    }
}
