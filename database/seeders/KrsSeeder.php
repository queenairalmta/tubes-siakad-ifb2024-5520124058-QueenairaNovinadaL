<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['npm' => '2210631001', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '2210631001', 'kode_matakuliah' => 'IF53401'],
            ['npm' => '2210631002', 'kode_matakuliah' => 'IF53413'],
        ];

        foreach ($data as $row) {
            Krs::create($row);
        }
    }
}