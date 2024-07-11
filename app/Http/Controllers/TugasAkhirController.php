<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasAkhirController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == 'dosen') {
            $dosen = Dosen::where('email', Auth::user()->email)->first();
            $tugas_akhirs = TugasAkhir::where('pembimbing1', $dosen->id)
                ->orWhere('pembimbing2', $dosen->id)
                ->get();
        } elseif (Auth::user()->level == 'kaprodi') {
            $tugas_akhirs = TugasAkhir::all();
        } elseif (Auth::user()->level == 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
            $tugas_akhirs = TugasAkhir::where('mahasiswa_id', $mahasiswa->id)->get();
        } elseif (Auth::user()->level == 'Admin') {
            $tugas_akhirs = TugasAkhir::all();
        } else {
            $tugas_akhirs = collect();
        }

        return view('pages.tugas_akhirs', compact('tugas_akhirs'));
    }


    public function validasi(Request $request, TugasAkhir $tugasAkhir)
    {
        $role = $request->input('role');

        if ($role == 'pembimbing') {
            $tugasAkhir->validasi_pembimbing = true;
        } elseif ($role == 'penguji') {
            $tugasAkhir->validasi_penguji = true;
        }

        $tugasAkhir->save();

        return redirect()->route('tugas_akhirs.show', $tugasAkhir)->with('success', 'Dokumen berhasil Divalidasi');
    }
    public function show($id)
    {
        $tugasAkhir = TugasAkhir::with(['mahasiswa', 'pembimbing_1', 'pembimbing_2'])->find($id);
        return view('crud.tugas_akhirshow', compact('tugasAkhir'));
    }


    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        $mahasiswalogin = Auth::user()->name;
        $datamahasiswa = Mahasiswa::where('nama', 'like', '%' . $mahasiswalogin . '%')->first();

        return view('crud.tugas_akhircreate', compact('mahasiswas', 'dosens', 'datamahasiswa'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255|string',
            'mahasiswa' => 'required|exists:mahasiswas,nama',
            'pembimbing1' => 'required|exists:dosens,nama',
            'pembimbing2' => 'required|exists:dosens,nama',
            'dokumen_laporan_pkl' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'dokumen_lembar_pembimbing' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'dokumen_proposal_tugas_akhir' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
            'dokumen_laporan_tugas_akhir' => 'nullable|file|mimes:pdf,doc,docx|max:7060',
        ]);

        $mahasiswa = Mahasiswa::where('nama', $validatedData['mahasiswa'])->firstOrFail();
        $pembimbing1 = Dosen::where('nama', $validatedData['pembimbing1'])->firstOrFail();
        $pembimbing2 = Dosen::where('nama', $validatedData['pembimbing2'])->firstOrFail();

        $tugasAkhir = new TugasAkhir();
        $tugasAkhir->judul = $validatedData['judul'];
        $tugasAkhir->mahasiswa_id = $mahasiswa->id;
        $tugasAkhir->pembimbing1 = $pembimbing1->id;
        $tugasAkhir->pembimbing2 = $pembimbing2->id;

        $documents = [
            'dokumen_laporan_pkl' => 'laporan_pkl',
            'dokumen_lembar_pembimbing' => 'lembar_pembimbing',
            'dokumen_proposal_tugas_akhir' => 'proposal_tugas_akhir',
            'dokumen_laporan_tugas_akhir' => 'laporan_tugas_akhir',
        ];

        foreach ($documents as $inputName => $documentType) {
            if ($request->hasFile($inputName)) {
                $filename = $request->file($inputName)->getClientOriginalName();
                $path = $request->file($inputName)->storeAs("public/upload/{$documentType}", $filename);
                $tugasAkhir->$inputName = $path;
            }
        }

        $tugasAkhir->save();

        return redirect()->route('tugas_akhirs.index')->with('success', 'Data Tugas Akhir Berhasil Dibuat.');
    }


    public function edit($id)
    {
        $tugasAkhir = TugasAkhir::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        return view('crud.tugas_akhiredit', compact('tugasAkhir', 'mahasiswas', 'dosens'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255|string',
            'mahasiswa' => 'required|exists:mahasiswas,id',
            'pembimbing1' => 'required|exists:dosens,id',
            'pembimbing2' => 'nullable|exists:dosens,id',
            'dokumen' => 'nullable|file|max:2048',
            'status' => 'nullable|string',
        ]);

        $tugas_akhirs = TugasAkhir::findOrFail($id);

        $tugas_akhirs->judul = $validatedData['judul'];
        $tugas_akhirs->mahasiswa_id = $validatedData['mahasiswa'];
        $tugas_akhirs->pembimbing1 = $validatedData['pembimbing1'];
        $tugas_akhirs->pembimbing2 = $validatedData['pembimbing2'];

        if ($request->hasFile('dokumen')) {
            $filename = $request->file('dokumen')->getClientOriginalName();
            $path = $request->file('dokumen')->storeAs('public/uploads', $filename);
            $tugas_akhirs->dokumen = $filename;
        }

        $tugas_akhirs->status = $validatedData['status'] ?? $tugas_akhirs->status;
        $tugas_akhirs->save();

        return redirect()->route('tugas_akhirs.index')->with('success', 'Data Tugas Akhir Berhasil Diperbarui!');
    }



    public function destroy($id)
    {
        $tugas_akhirs = TugasAkhir::findOrFail($id);

        if ($tugas_akhirs->dokumen) {
            Storage::delete($tugas_akhirs->dokumen);
        }

        $tugas_akhirs->delete();

        return redirect()->route('tugas_akhirs.index')->with('success', 'Data Tugas Akhir Berhasil Dihapus!');
    }
}
