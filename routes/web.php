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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 1. RUTE KHUSUS ADMIN (Hanya admin yang bisa akses CRUD Data)
Route::middleware(['auth', 'cek-role:admin'])->group(function () {
    Route::resource('/mahasiswa', MahasiswaController::class);
    Route::resource('/dosen', DosenController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/matakuliah', MatakuliahController::class);
    Route::resource('/kelas', KelasController::class);
});

// 2. RUTE KHUSUS DOSEN (Hanya dosen yang bisa Melihat data yang sudah diinput oleh Admin tanpa bisa melakukan apapun. serta Dosen memiliki kemampuan untuk melakukan proses approval/reject(hanya mengubah status di KRS dan KRS_detail))
Route::middleware(['auth', 'cek-role:dosen'])->group(function () {
    Route::get('/krs-approval', [KRSController::class, 'approvalPage']);
    Route::post('/krs-approval/{id}', [KRSController::class, 'approvalAction']);
});

// 3. RUTE KHUSUS MAHASISWA (Hanya mahasiswa yang bisa akses menu Daftar KRS yang berisi Index, Pendaftaran dan Detail KRS)
Route::middleware(['auth', 'cek-role:mahasiswa'])->group(function () {
    Route::resource('/krs', KRSController::class);
});