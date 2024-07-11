<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    use HasFactory;

    protected $table = 'sidangs';
    protected $fillable = [
        'id_tugasakhir',
        'tanggal',
        'id_ruang',
        'sesi',
        'ketua_sidang',
        'sekretaris_sidang',
        'anggota',
        'status_kelulusan'
    ];

    public function tugasAkhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'id_tugasakhir');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruang');
    }

    public function ketua()
    {
        return $this->belongsTo(Dosen::class, 'ketua_sidang');
    }

    public function sekretaris()
    {
        return $this->belongsTo(Dosen::class, 'sekretaris_sidang');
    }
    public function anggota()
    {
        return $this->belongsTo(Dosen::class, 'anggota');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_tugasakhir');
    }
}
