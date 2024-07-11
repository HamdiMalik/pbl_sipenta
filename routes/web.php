<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\TugasAkhirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */



Route::get('/', function () {
    return view('landingpage');
});
Route::get('/panduan-sidang', function () {
    return view('layout.panduan-sidang');
});
Route::get('/penjadwalan-sidang', function () {
    return view('layout.penjadwalan-sidang');
});
Route::get('/kuota-sidang', function () {
    return view('layout.kuota-sidang');
});
Route::get('/dasboard', function () {
    return view('pages.dasboard');
});

//login dan register
Route::get('/login', function () {
    return view('pengguna.login');
});
Route::post('/register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'post_login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    //user
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/exportuser', [UserController::class, 'export']);
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import');


    //Dosen
    Route::get('/dosen', function () {
        return view('dosen');
    });
    Route::resource('dosen', DosenController::class);
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::get('/dosen/{id}/edit', 'DosenController@edit')->name('dosen.edit');
    Route::post('dosen/{id}/update', [DosenController::class, 'update'])->name('dosen.update');
    Route::get('/exportdosen', [DosenController::class, 'export']);
    Route::post('dosens/import', [DosenController::class, 'import'])->name('dosens.import');

    //Mahasiswa
    Route::get('/mahasiswas', function () {
        return view('mahasiswa');
    });
    Route::resource('mahasiswas', MahasiswaController::class);
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::get('/exportmahasiswa', [MahasiswaController::class, 'export']);
    Route::post('/mahasiswas/import', [MahasiswaController::class, 'import'])->name('mahasiswas.import');

    //Ruangan
    Route::get('/ruangan', function () {
        return view('ruangan');
    });
    Route::resource('ruangan', RuanganController::class);
    Route::get('/ruangan/{ruangan}', [RuanganController::class, 'show'])->name('ruangan.show');

    //Tugas Akhir
    Route::get('/tugas_akhirs', function () {
        return view('tugas_akhirs');
    });
    Route::resource('tugas_akhirs', TugasAkhirController::class);
    Route::post('/tugas_akhirs', [TugasAkhirController::class, 'store'])->name('tugas_akhirs.store');
    Route::get('/tugas_akhirs/create', [TugasAkhirController::class, 'create'])->name('tugas_akhirs.create');
    Route::put('/tugas_akhirs/{tugasAkhir}/edit', [TugasAkhirController::class, 'update'])->name('tugas_akhirs.update');
    Route::put('/tugas_akhirs/{tugasAkhir}', [TugasAkhirController::class, 'update'])->name('tugas_akhirs.update');
    Route::delete('/tugas_akhirs/{tugasAkhir}', [TugasAkhirController::class, 'destroy'])->name('tugas_akhirs.destroy');
    Route::get('/tugas_akhirs/{id}', [TugasAkhirController::class, 'show'])->name('tugas_akhirs.show');
    Route::put('/tugas_akhirs/{tugasAkhir}/validasi', [TugasAkhirController::class, 'validasi'])->name('tugas_akhirs.validasi');


    //Penilaian
    Route::get('/penilaian', function () {
        return view('penilaian');
    });
    Route::resource('penilaian', PenilaianController::class);
    Route::get('/penilaian', [PenilaianController::class, 'index']);
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/{id}', [PenilaianController::class, 'show'])->name('penilaian.show');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::put('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
    Route::get('/tambahpenilaian/{id}', [PenilaianController::class, 'tambah_penilaian']);
    Route::get('/tambahpenilaian/{id}', [PenilaianController::class, 'tambah_penilaian'])->name('tambah_penilaian');

    //Sidang
    Route::resource('sidang', SidangController::class);
    Route::get('/sidang', [SidangController::class, 'index'])->name('sidang.index');
    Route::get('/sidangs', [SidangController::class, 'index'])->name('sidang.index');
    Route::get('/sidang/{id}', [SidangController::class, 'show'])->name('sidang.show');
    Route::post('/sidang/create', [SidangController::class, 'create'])->name('sidang.create');
    Route::post('/sidang', [SidangController::class, 'store'])->name('sidang.store');
    Route::get('/sidang/{id}/edit', [SidangController::class, 'edit'])->name('sidang.edit');
    Route::put('/sidang/{id}', [SidangController::class, 'update'])->name('sidang.update');
    Route::delete('/sidang/{id}', [SidangController::class, 'destroy'])->name('sidang.destroy');
});
