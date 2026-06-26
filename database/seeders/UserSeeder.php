<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin
        User::create([
            'name' => 'Admin SIAKAD',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'npm' => null,
        ]);

        // Akun mahasiswa (npm wajib cocok dengan data di tabel mahasiswa)
        User::create([
            'name' => 'Queenaira',
            'email' => 'queen@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'npm' => '2210631001',
        ]);

        User::create([
            'name' => 'Dewi Anggraini',
            'email' => 'dewi@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'npm' => '2210631002',
        ]);
    }
}