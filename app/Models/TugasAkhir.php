<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    protected $fillable = [
        'judul', 'mahasiswa_id', 'pembimbing1', 'pembimbing2', 'dokumen', 'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
    public function pembimbing_1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing1');
    }

    public function pembimbing_2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing2');
    }


    public function penilaians()
    {
        return $this->hasOne(Penilaian::class, 'id_tugasakhir');
    }
}
