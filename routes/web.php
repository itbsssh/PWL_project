<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\KRSDetailController;

Route::get('/mahasiswa/create', function () {
    dd('CREATE ROUTE');
});

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// 1. RUTE READ (Bisa diakses Admin DAN Dosen)
Route::middleware(['auth', 'cek-role:admin,dosen'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show']);
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::get('/matakuliah', [MatakuliahController::class, 'index']);
    Route::get('/kelas', [KelasController::class, 'index']);
});

// 2. RUTE CUD (Hanya Admin)
Route::middleware(['auth', 'cek-role:admin'])->group(function () {
    Route::resource('/mahasiswa', MahasiswaController::class)->except(['index', 'show']);
    Route::resource('/dosen', DosenController::class)->except(['index', 'show']);
    Route::resource('/jurusan', JurusanController::class)->except(['index', 'show']);
    Route::resource('/matakuliah', MatakuliahController::class)->except(['index', 'show']);
    Route::resource('/kelas', KelasController::class)->except(['index', 'show']);
});

// 2. RUTE KHUSUS DOSEN (Hanya dosen yang bisa Melihat data yang sudah diinput oleh Admin tanpa bisa melakukan apapun. serta Dosen memiliki kemampuan untuk melakukan proses approval/reject(hanya mengubah status di KRS dan KRS_detail))
Route::middleware(['auth', 'cek-role:dosen'])->group(function () {
    // Dosen melihat daftar semua KRS yang diajukan mahasiswa
    Route::get('/krs-approval', [KRSController::class, 'indexDosen'])->name('dosen.krs.index');
    
    // Dosen mengubah status (Approve/Reject)
    Route::patch('/krs-approval/{id}', [App\Http\Controllers\KRSController::class, 'updateStatus'])->name('dosen.krs.update');
});

// 3. RUTE KHUSUS MAHASISWA (Hanya mahasiswa yang bisa akses menu Daftar KRS yang berisi Index, Pendaftaran dan Detail KRS)
Route::middleware(['auth', 'cek-role:mahasiswa'])->group(function () {
    Route::resource('/krs', KRSController::class);
});