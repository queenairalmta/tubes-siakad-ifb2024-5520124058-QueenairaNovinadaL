<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['npm' => '2210631001', 'nidn' => '0001018501', 'nama' => 'Queenaira'],
            ['npm' => '2210631002', 'nidn' => '0001018501', 'nama' => 'Dewi Anggraini'],
            ['npm' => '2210631003', 'nidn' => '0002028502', 'nama' => 'Putri Ayu'],
            ['npm' => '2210631004', 'nidn' => '0003038503', 'nama' => 'Rizky Maulana'],
        ];

        foreach ($data as $row) {
            Mahasiswa::create($row);
        }
    }
}