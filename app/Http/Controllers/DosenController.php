<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\User;
use App\Exports\dosenExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;


class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nama')->get();
        return view('pages.dosen', compact('dosens'));
    }
    public function export()
    {
        return Excel::download(new dosenExport, 'dosen.xlsx');
    }

    public function import(Request $request)
    {
        // if (!Gate::allows('isAdmin')) {
        //     return redirect('/');
        // }

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
                'nip' => $rowData[2],
                'no_telp' => $rowData[3],
                'jabatan' => $rowData[4],
                'email' => $rowData[5],
            ], [
                'nama' => 'required|string|max:255',
                'nip' => 'required|max:255',
                'no_telp' => 'required|max:255',
                'jabatan' => 'required|string|max:255',
                'email' => 'required|max:255|email|unique:dosens,email',
            ]);

            if ($validator->fails()) {
                $errorMessages[] = "Row {$row->getRowIndex()}: " . implode(', ', $validator->errors()->all());
                continue;
            }

            // Validasi berhasil, simpan data ke dalam basis data
            try {
                $dosen = Dosen::create([
                    'nama' => $rowData[1],
                    'nip' => $rowData[2],
                    'no_telp' => $rowData[3],
                    'jabatan' => $rowData[4],
                    'email' => $rowData[5],
                    'password' => '-',
                ]);
                $successCount++;
                // if ($dosen) {
                //     logaktivitas::create([
                //         'user_id' => Auth::id(),
                //         'aktivitas' => 'Menambah data dosen dengan id = ' . $dosen->id
                //     ]);
                //     $successCount++;
                // } else {
                //     $errorMessages[] = "Row {$row->getRowIndex()}: Gagal menyimpan data dosen.";
                // }
            } catch (\Exception $e) {
                $errorMessages[] = "Row {$row->getRowIndex()}: Exception - " . $e->getMessage();
                continue;
            }
        }
        // $activityLogController = new ActivityLogController();
        // $activityLogController->store('Mengimport data pengguna dengan id = ' . $dosen->id);

        if ($successCount > 0) {
            return redirect('/dosen')->with('success', 'Data Dosen Berhasil Diimpor.')->with('errors', $errorMessages);
        } else {
            return redirect('/dosen')->with('error', 'Tidak Ada Data Dosen Yang Valid Diimpor.')->with('errors', $errorMessages);
        }
    }


    public function create()
    {
        return view('crud.dosencreate');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nip' => 'required|unique:dosens',
            'no_telp' => 'required|string',
            'email' => 'required|email|unique:dosens',
            'jabatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dosenData = $request->all();

        if ($request->hasFile('foto')) {
            try {
                $fileName = time() . '.' . $request->foto->getClientOriginalExtension();
                $request->foto->storeAs('public/uploads', $fileName); // Store in 'public/uploads'
                $dosenData['foto'] = $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal Mengunggah Foto Profil.'])->withInput();
            }
        }

        Log::info('Data to be inserted into User:', $dosenData);
        Dosen::create($dosenData);

        if ($dosenData) {
            User::create([
                'name' => $dosenData['nama'],
                'level' => 'dosen',
                'email' => $dosenData['email'],
                'password' => Hash::make($dosenData['nip'])
            ]);
        }
        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Ditambahkan!');
    }

    public function show(Dosen $dosen)
    {
        return view('crud.dosenshow', compact('dosen'));
    }
    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('crud.dosenedit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findorfail($id);
        if (!Gate::allows('isAdmin', $id)) {
            abort(403);
        }
        //bodoh
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nip' => 'required|unique:dosens,nip,' . $id,
            'no_telp' => 'required|string',
            'email' => 'required|email|unique:dosens,email,' . $id,
            'jabatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $dosenData = $request->all();

        if ($request->hasFile('foto')) {
            try {
                $fileName = time() . '.' . $request->foto->getClientOriginalExtension();
                $request->foto->storeAs('public/uploads', $fileName);
                $dosenData['foto'] = $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['upload_error' => 'Gagal Mengunggah Foto Profil.'])->withInput();
            }
        }

        $dosen->update($dosenData);

        return redirect('/dosen')->with('success', 'Data Dosen Berhasil Diperbarui');
    }

    public function destroy($id)

    {
        $data = Dosen::find($id);
        $data->delete();
        return redirect('/dosen')->with('success', 'Data Dosen Berhasil Dihapus');
    }
}
