<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use App\Exports\mahasiswaExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = mahasiswa::all();

        return view('pages.mahasiswas', compact('mahasiswas'));
    }

    public function export()
    {
        return Excel::download(new mahasiswaExport, 'mahasiswa.xlsx');
    }

    public function import(Request $request)
    {
        /* if (!Gate::allows('isAdmin')) {
        return redirect('/');
    }  */
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $successCount = 0;
        $errorMessages = [];

        foreach ($sheet->getRowIterator() as $row) {
            // Skip header row
            if ($row->getRowIndex() == 1) {
                continue;
            }

            $rowData = [];

            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            // Validasi data
            $validator = Validator::make([
                'nama' => $rowData[1],
                'nim' => $rowData[2],
                'prodi' => $rowData[3],
                'angkatan' => $rowData[4],
                'ipk' => $rowData[5],
                'email' => $rowData[6]
                /*   'password' => $rowData[4]  */
            ], [
                'nama' => 'required|string|max:255',
                'nim' => 'required|max:255',
                'prodi' => 'required|string|max:255',
                'angkatan' => 'required|max:255',
                'ipk' => 'required|max:255',
                'email' => 'required|max:255|email|unique:mahasiswas,email'
            ]);

            if ($validator->fails()) {
                dd(0);
                continue;
            }

            // Validasi berhasil, simpan data ke dalam basis data
            try {
                $mahasiswa = mahasiswa::create([
                    'nama' => $rowData[1],
                    'nim' => $rowData[2],
                    'prodi' => $rowData[3],
                    'angkatan' => $rowData[4],
                    'ipk' => $rowData[5],
                    'email' => $rowData[6],
                    'foto' => '-'
                ]);
                $successCount++;
                /* if ($user) {
                logaktivitas::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => 'Menambah data user dengan id = ' . $user->id
                ]);
                $successCount++;
            } else {
                $errorMessages[] = "Row {$row->getRowIndex()}: Gagal menyimpan data user.";
            } */
            } catch (\Exception $e) {
                continue;
            }
        }
        /*  $activityLogController = new ActivityLogController();
        $activityLogController->store('Mengimport data pengguna dengan id = ' . $user->id); */

        if ($successCount > 0) {
            return redirect('/mahasiswas')->with('success', 'Data Mahasiswa Berhasil Diimpor.');
        } else {
            return redirect('/mahasiswas')->with('error', 'Tidak Ada Data Mahasiswa Yang Valid Diimpor.');
        }
    }
    public function create()
    {
        return view('crud.mahasiswacreate');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim|max:255',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'ipk' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswaData = $request->all();

        if ($request->hasFile('foto')) {
            try {
                $fileName = time() . '.' . $request->foto->getClientOriginalExtension();
                $request->foto->storeAs('public/uploads', $fileName); // Store in 'public/uploads'
                $mahasiswaData['foto'] = $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal Mengunggah Foto Profil.'])->withInput();
            }
        }

        $mahasiswa = Mahasiswa::create($mahasiswaData);
        if ($mahasiswa) {
            User::create([
                'name' => $mahasiswaData['nama'],
                'level' => 'mahasiswa',
                'email' => $mahasiswaData['email'],
                'angkatan' => $mahasiswaData['angkatan'],
                'ipk' => $mahasiswaData['ipk'],
                'password' => Hash::make($mahasiswaData['nim']),
            ]);
        }

        return redirect()->route('mahasiswas.index')->with('success', 'Data Mahasiswa Berhasil Ditambahkan!');
    }


    public function show($id)
    {
        $mahasiswa = mahasiswa::findOrFail($id);

        return view('crud.mahasiswashow', compact('mahasiswa'));
    }


    public function edit(mahasiswa $mahasiswa)
    {
        return view('crud.mahasiswaedit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim,' . $mahasiswa->id . '|max:255',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'ipk' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswaData = $request->all();

        if ($request->hasFile('foto')) {
            try {
                if ($mahasiswa->foto && Storage::exists('public/uploads/' . $mahasiswa->foto)) {
                    Storage::delete('public/uploads/' . $mahasiswa->foto);
                }

                $fileName = time() . '.' . $request->foto->getClientOriginalExtension();
                $request->foto->storeAs('public/uploads', $fileName); // Store in 'public/uploads'
                $mahasiswaData['foto'] = $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['upload_error' => 'Gagal Mengunggah Foto Profil.'])->withInput();
            }
        }

        $mahasiswa->update($mahasiswaData);

        return redirect()->route('mahasiswas.index')->with('success', 'Data Mahasiswa Berhasil Diubah!');
    }
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->tugasAkhirs()->delete();
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')
            ->with('success', ' Data Mahasiswa Berhasil Dihapus!');
    }
}
