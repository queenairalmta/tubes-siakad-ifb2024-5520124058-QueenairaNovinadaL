<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_matakuliah' => 'IF53413', 'nidn' => '0001018501', 'kelas' => 'A', 'hari' => 'Senin', 'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF53401', 'nidn' => '0002028502', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '10:00:00'],
            ['kode_matakuliah' => 'IF53402', 'nidn' => '0003038503', 'kelas' => 'B', 'hari' => 'Rabu', 'jam' => '13:00:00'],
            ['kode_matakuliah' => 'IF53403', 'nidn' => '0001018501', 'kelas' => 'A', 'hari' => 'Kamis', 'jam' => '08:00:00'],
        ];

        foreach ($data as $row) {
            Jadwal::create($row);
        }
    }
}