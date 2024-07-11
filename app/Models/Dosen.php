<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'nip',
        'no_telp',
        'jabatan',
        'email',
        'foto',
    ];
    public function tugasAkhir()
    {
        return $this->hasMany(TugasAkhir::class, 'pembimbing1')
            ->orWhere('pembimbing2', 'id');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'dosen_penguji');
    }

    public function pembimbing_1()
    {
        return $this->hasmany(tugasakhir::class, 'id');
    }

    public function pembimbing_2()
    {
        return $this->hasmany(tugasakhir::class, 'id');
    }
    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'ketua_sidang');
    }
}
