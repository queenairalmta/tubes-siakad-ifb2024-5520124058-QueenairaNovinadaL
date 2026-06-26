<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    public function krsExcel()
    {
        $data = Krs::with(['mahasiswa', 'mataKuliah'])->get()->map(function ($krs) {
            return [
                'NPM'              => $krs->npm,
                'Nama Mahasiswa'   => $krs->mahasiswa->nama ?? '-',
                'Kode Mata Kuliah' => $krs->mataKuliah->kode_matakuliah ?? '-',
                'Nama Mata Kuliah' => $krs->mataKuliah->nama_matakuliah ?? '-',
                'SKS'              => $krs->mataKuliah->sks ?? '-',
            ];
        });

        return (new FastExcel($data))->download('data_krs_mahasiswa.xlsx');
    }
}