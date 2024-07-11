<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with('dosenPenguji', 'tugasAkhir')->paginate(10);

        foreach ($penilaians as $penilaian) {
            Log::info('Penilaian: ', ['id' => $penilaian->id, 'dosenPenguji' => $penilaian->dosenPenguji]);
        }

        return view('pages.penilaian', compact('penilaians'));
    }
    public function show($id)
    {
        $penilaian = Penilaian::with('tugasAkhir', 'dosenPenguji')->findOrFail($id);

        return view('crud.penilaianshow', compact('penilaian'));
    }

    public function create()
    {
        $tugasAkhir = TugasAkhir::all();
        $dosen = Dosen::all();
        $kategori = 'D3';

        return view('crud.penilaiancreate', compact('tugasAkhir', 'dosen'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tugasakhir' => 'required|integer|exists:tugas_akhirs,id',
            'dosen_penguji' => 'required|integer|exists:dosens,id',
            'presentasi_sikap_penampilan' => 'required|numeric|min:0|max:100',
            'presentasi_komunikasi_sistematika' => 'required|numeric|min:0|max:100',
            'presentasi_penguasaan_materi' => 'required|numeric|min:0|max:100',
            'makalah_identifikasi_masalah' => 'required|numeric|min:0|max:100',
            'makalah_relevansi_teori' => 'required|numeric|min:0|max:100',
            'makalah_metode_algoritma' => 'required|numeric|min:0|max:100',
            'makalah_hasil_pembahasan' => 'required|numeric|min:0|max:100',
            'makalah_kesimpulan_saran' => 'required|numeric|min:0|max:100',
            'makalah_bahasa_tata_tulis' => 'required|numeric|min:0|max:100',
            'produk_kesesuaian_fungsional' => 'required|numeric|min:0|max:100',
            'komentar' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the Tugas Akhir and the associated Mahasiswa
        $tugasAkhir = TugasAkhir::find($request->id_tugasakhir);
        $mahasiswa = Mahasiswa::find($tugasAkhir->mahasiswa_id);

        // Calculate total score based on D3 or D4 logic
        if (str_contains($mahasiswa->prodi, 'D4')) {
            $totalNilai = $request->presentasi_sikap_penampilan * 0.05 +
                $request->presentasi_komunikasi_sistematika * 0.05 +
                $request->presentasi_penguasaan_materi * 0.20 +
                $request->makalah_identifikasi_masalah * 0.05 +
                $request->makalah_relevansi_teori * 0.05 +
                $request->makalah_metode_algoritma * 0.10 +
                $request->makalah_hasil_pembahasan * 0.15 +
                $request->makalah_kesimpulan_saran * 0.05 +
                $request->makalah_bahasa_tata_tulis * 0.05 +
                $request->produk_kesesuaian_fungsional * 0.25;
        } else {
            $totalNilai = $request->presentasi_sikap_penampilan * 0.10 +
                $request->presentasi_komunikasi_sistematika * 0.10 +
                $request->presentasi_penguasaan_materi * 0.20 +
                $request->makalah_identifikasi_masalah * 0.10 +
                $request->makalah_relevansi_teori * 0.10 +
                $request->makalah_metode_algoritma * 0.10 +
                $request->makalah_hasil_pembahasan * 0.10 +
                $request->makalah_kesimpulan_saran * 0.10 +
                $request->makalah_bahasa_tata_tulis * 0.10;
        }

        // Create the Penilaian record
        $penilaian = Penilaian::create([
            'id_tugasakhir' => $request->id_tugasakhir,
            'dosen_penguji' => $request->dosen_penguji,
            'nilai' => $totalNilai,
            'komentar' => $request->komentar,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Data Penilaian Berhasil Dibuat!');
    }

    public function edit($id)
    {
        $penilaian = Penilaian::with('tugasAkhir', 'dosenPenguji')->findOrFail($id);
        $tugasAkhir = TugasAkhir::all();
        $dosen = Dosen::all();

        return view('crud.penilaianedit', compact('penilaian', 'tugasAkhir', 'dosen'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_tugasakhir' => 'required|integer|exists:tugas_akhirs,id',
            'dosen_penguji' => 'required|integer|exists:dosens,id',
            'presentasi_sikap_penampilan' => 'required|numeric|min:0|max:100',
            'presentasi_komunikasi_sistematika' => 'required|numeric|min:0|max:100',
            'presentasi_penguasaan_materi' => 'required|numeric|min:0|max:100',
            'makalah_identifikasi_masalah' => 'required|numeric|min:0|max:100',
            'makalah_relevansi_teori' => 'required|numeric|min:0|max:100',
            'makalah_metode_algoritma' => 'required|numeric|min:0|max:100',
            'makalah_hasil_pembahasan' => 'required|numeric|min:0|max:100',
            'makalah_kesimpulan_saran' => 'required|numeric|min:0|max:100',
            'makalah_bahasa_tata_tulis' => 'required|numeric|min:0|max:100',
            'produk_kesesuaian_fungsional' => 'required|numeric|min:0|max:100',
            'komentar' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $totalNilai = $request->presentasi_sikap_penampilan * 0.05 +
            $request->presentasi_komunikasi_sistematika * 0.05 +
            $request->presentasi_penguasaan_materi * 0.20 +
            $request->makalah_identifikasi_masalah * 0.05 +
            $request->makalah_relevansi_teori * 0.05 +
            $request->makalah_metode_algoritma * 0.10 +
            $request->makalah_hasil_pembahasan * 0.15 +
            $request->makalah_kesimpulan_saran * 0.05 +
            $request->makalah_bahasa_tata_tulis * 0.05 +
            $request->produk_kesesuaian_fungsional * 0.25;

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update([
            'id_tugasakhir' => $request->id_tugasakhir,
            'dosen_penguji' => $request->dosen_penguji,
            'nilai' => $totalNilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Data Penilaian Berhasil Diperbarui!');
    }
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();
        return redirect()->route('penilaian.index')->with('success', 'Data Penilaian Berhasil Dihapus!');
    }
}
