<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'angkatan',
        'ipk',
        'email',
        'foto',
    ];

    public function tugasAkhirs()
    {
        return $this->hasMany(TugasAkhir::class);
    }
}
