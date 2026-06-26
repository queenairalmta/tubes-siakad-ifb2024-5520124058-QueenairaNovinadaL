<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nidn' => '0001018501', 'nama' => 'Dr. Andi Saputra, M.Kom'],
            ['nidn' => '0002028502', 'nama' => 'Sri Rahayu, M.T.'],
            ['nidn' => '0003038503', 'nama' => 'Budi Irawan, M.Kom'],
        ];

        foreach ($data as $row) {
            Dosen::create($row);
        }
    }
}