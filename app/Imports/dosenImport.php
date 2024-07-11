<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;

class dosenImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dosen([
            'nama' => $row['nama'], //Pastikan nama kolom sesuai dengan header di file Excel
            'nip' => $row['nip'],
            'no_telp' => $row['no_telp'],
            'jabatan' => $row['jabatan'],
            'email' => $row['email'],
        ]);
    }
}