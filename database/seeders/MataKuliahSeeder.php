<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_matakuliah' => 'IF53413', 'nama_matakuliah' => 'Pemrograman Web II', 'sks' => 3],
            ['kode_matakuliah' => 'IF53401', 'nama_matakuliah' => 'Basis Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53402', 'nama_matakuliah' => 'Struktur Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53403', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 2],
        ];

        foreach ($data as $row) {
            MataKuliah::create($row);
        }
    }
}