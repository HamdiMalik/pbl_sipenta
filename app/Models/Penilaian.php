<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaians';
    protected $fillable = [
        'id_tugasakhir',
        'dosen_penguji',
        'nilai',
        'komentar',
    ];

    public function tugasAkhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'id_tugasakhir');
    }

    public function dosenPenguji()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji');
    }
    public function hitungTotalNilai($request)
    {
        // Validate input
        $validatedData = $request->validate([
            // Add validation rules for presentation and paper values here
        ]);

        // Calculate total nilai based on weights
        $totalNilai =
            ($validatedData['presentasi_sikap_penampilan'] * 0.05) +
            ($validatedData['presentasi_komunikasi_sistematika'] * 0.05) +
            ($validatedData['presentasi_penguasaan_materi'] * 0.20) +
            ($validatedData['makalah_identifikasi_masalah'] * 0.05) +
            ($validatedData['makalah_relevansi_teori'] * 0.05) +
            ($validatedData['makalah_metode_algoritma'] * 0.10) +
            ($validatedData['makalah_hasil_pembahasan'] * 0.15) +
            ($validatedData['makalah_kesimpulan_saran'] * 0.05) +
            ($validatedData['makalah_bahasa_tata_tulis'] * 0.05) +
            ($validatedData['produk_kesesuaian_fungsional'] * 0.25);

        // Return total nilai
        return $totalNilai;
    }
}
