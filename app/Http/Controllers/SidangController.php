<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sidang;
use App\Models\TugasAkhir;
use App\Models\Ruangan;
use App\Models\Penilaian;
use App\Models\Dosen;

class SidangController extends Controller
{
    public function index()
    {
        $sidangs = Sidang::all();
        return view('pages.sidang', compact('sidangs'));
    }

    public function create()
    {
        $tugasAkhirs = TugasAkhir::all();
        $ruangans = Ruangan::all();
        $dosens = Dosen::all();
        return view('crud.sidangcreate', compact('tugasAkhirs', 'ruangans', 'dosens'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_tugasakhir' => 'required|integer',
            'tanggal' => 'required|date',
            'id_ruang' => 'required|integer',
            'sesi' => 'required|integer',
            'ketua_sidang' => 'required|string|max:255',
            'sekretaris_sidang' => 'required|string|max:255',
            'anggota' => 'required|array',
        ]);

        // Periksa konflik jadwal dosen
        $conflict = Sidang::where('tanggal', $validatedData['tanggal'])
            ->where('sesi', $validatedData['sesi'])
            ->where(function ($query) use ($validatedData) {
                $query->where('ketua_sidang', $validatedData['ketua_sidang'])
                    ->orWhere('sekretaris_sidang', $validatedData['sekretaris_sidang'])
                    ->orWhereIn('anggota', $validatedData['anggota']);
            })
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Salah Satu Dosen Sudah Terdaftar Sebagai Penguji Pada Tanggal Yang Sama. Silakan Pilih Dosen Lain.');
        }

        $sidang = new Sidang;
        $sidang->id_tugasakhir = $validatedData['id_tugasakhir'];
        $sidang->tanggal = $validatedData['tanggal'];
        $sidang->id_ruang = $validatedData['id_ruang'];
        $sidang->sesi = $validatedData['sesi'];
        $sidang->ketua_sidang = $validatedData['ketua_sidang'];
        $sidang->sekretaris_sidang = $validatedData['sekretaris_sidang'];
        $sidang->anggota = implode(',', $validatedData['anggota']);

        $nilai = Penilaian::where('id_tugasakhir', $sidang->id_tugasakhir)->value('nilai');
        $sidang->status_kelulusan = $nilai > 80 ? 'lulus' : 'tidak lulus';

        $sidang->save();

        return redirect()->route('sidang.index')->with('success', 'Data Sidang Berhasil Dibuat');
    }



    public function show($id)
    {
        $sidang = Sidang::with(['tugasAkhir.mahasiswa', 'tugasAkhir.pembimbing_1', 'tugasAkhir.pembimbing_2', 'penilaians.dosenPenguji', 'ruangan', 'ketua', 'sekretaris', 'anggota'])->find($id);
        if (!$sidang) {
            return abort(404);
        }

        $nilai = Penilaian::where('id_tugasakhir', $sidang->id_tugasakhir)->value('nilai');
        $sidang->status_kelulusan = $nilai > 65 ? 'lulus' : 'tidak lulus';

        return view('crud.sidangshow', compact('sidang'));
    }



    public function edit(Sidang $sidang)
    {
        $tugasAkhirs = TugasAkhir::all();
        $ruangans = Ruangan::all();
        $dosens = Dosen::all();

        return view('crud.sidangedit', compact('sidang', 'tugasAkhirs', 'ruangans', 'dosens'));
    }

    public function update(Request $request, Sidang $sidang)
    {
        $request->validate([
            'id_tugasakhir' => 'required',
            'tanggal' => 'required',
            'id_ruang' => 'required',
            'sesi' => 'required',
            'ketua_sidang' => 'required',
            'sekretaris_sidang' => 'required',
            'anggota' => 'required'
        ]);

        $sidang->id_tugasakhir = $request->input('id_tugasakhir');
        $sidang->tanggal = $request->input('tanggal');
        $sidang->id_ruang = $request->input('id_ruang');
        $sidang->sesi = $request->input('sesi');
        $sidang->ketua_sidang = $request->input('ketua_sidang');
        $sidang->sekretaris_sidang = $request->input('sekretaris_sidang');
        $sidang->anggota = $request->input('anggota');
        $sidang->save();

        return redirect()->route('sidang.index')->with('success', 'Data Sidang Berhasil Diperbarui');
    }

    public function destroy(Sidang $sidang)
    {
        $sidang->delete();
        return redirect()->route('sidang.index')->with('success', 'Data Sidang Berhasil DIhapus');
    }
}
