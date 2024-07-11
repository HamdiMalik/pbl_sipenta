<?php

namespace App\Imports;

use App\Models\mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class mahasiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new mahasiswa([
            'nama' => $row['nama'], //Pastikan nama kolom sesuai dengan header di file Excel
            'nim' => $row['nim'],
            'prodi' => $row['prodi'],
            'angkatan' => $row['angkatan'],
            'ipk' => $row['ipk'],
            'email' => $row['email']
        ]);
    }
}
