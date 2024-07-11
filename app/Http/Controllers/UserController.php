<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /*  public function __construct()
    {
        $this->middleware('level:admin');
    } */
    public function index()
    {

        $users = User::all();
        return view('pengguna.users', compact('users'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
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

        // dd($sheet);

        $successCount = 1;
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

            // dd('masuk');
            // Validasi data
            $validator = Validator::make([
                'name' => $rowData[1], // Adjust index according to your data structure
                'level' => $rowData[2], // Adjust index according to your data structure
                'email' => $rowData[3], // Adjust index according to your data structure
            ], [
                'name' => 'required|string|max:255',
                'level' => 'required|max:255',
                'email' => 'required|max:255|email|unique:users',
            ]);

            if ($validator->fails()) {
                $errorMessages[] = "Row {$row->getRowIndex()}: " . implode(', ', $validator->errors()->all());
                continue;
            }

            // Validasi berhasil, simpan data ke dalam basis data
            try {
                $user = User::create([
                    'name' => $rowData[1], // Adjust index according to your data structure
                    'level' => $rowData[2],  // Adjust index according to your data structure
                    'email' => $rowData[3], // Adjust index according to your data structure
                    'password' => '-', // Adjust index according to your data structure
                ]);
                $successCount++;
                // if ($user) {
                //     logaktivitas::create([
                //         'user_id' => Auth::id(),
                //         'aktivitas' => 'Menambah data user dengan id = ' . $user->id
                //     ]);
                //     $successCount++;
                // } else {
                //     $errorMessages[] = "Row {$row->getRowIndex()}: Gagal menyimpan data user.";
                // }
            } catch (\Exception $e) {
                $errorMessages[] = "Row {$row->getRowIndex()}: Exception - " . $e->getMessage();
                continue;
            }
        }
        // $activityLogController = new ActivityLogController();
        // $activityLogController->store('Mengimport data pengguna dengan id = ' . $user->id);

        if ($successCount > 0) {
            return redirect('/users')->with('success', 'Data User berhasil diimpor.')->with('errors', $errorMessages);
        } else {
            return redirect('/users')->with('error', 'Tidak ada data User yang valid diimpor.')->with('errors', $errorMessages);
        }
    }

    public function create()
    {
        return view('pengguna.usercreate');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'level' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('users.index')->with('success', 'User Baru Berhasil Dibuat!');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pengguna.usershow', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pengguna.useredit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'level' => ['nullable', 'string', 'max:255'], // Pastikan validasi level ada jika diperlukan
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->level = $request->level;

        $user->save();

        return redirect()->route('users.index')->with('success', 'Data User Berhasil Diperbarui!');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek apakah user yang akan dihapus adalah admin
        if ($user->level == 'Admin') {
            // Jika ya, tolak permintaan penghapusan dengan pesan kesalahan
            return redirect()->route('users.index')->with('error', 'Anda Tidak Dapat Menghapus Data Admin');
        }

        // Hapus user yang bukan admin
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data User Berhasil Dihapus!');
    }
}
