<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::get('/mahasiswa-create', [MahasiswaController::class, 'create'])->name('mahasiswa.add');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.save');
Route::get('/mahasiswa-edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.update');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.edit');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');

// --- ROUTE DOSEN ---
Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/dosen-create', [DosenController::class, 'create'])->name('dosen.add');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.save');
Route::get('/dosen-edit/{id}', [DosenController::class, 'edit'])->name('dosen.update');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.edit');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.delete');

// --- ROUTE JURUSAN ---
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::get('/jurusan-create', [JurusanController::class, 'create'])->name('jurusan.add');
Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.save');
Route::get('/jurusan-edit/{id}', [JurusanController::class, 'edit'])->name('jurusan.update');
Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.edit');
Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.delete');

// --- ROUTE MATA KULIAH ---
Route::get('/mata-kuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
Route::get('/mata-kuliah-create', [MatakuliahController::class, 'create'])->name('matakuliah.add');
Route::post('/mata-kuliah', [MatakuliahController::class, 'store'])->name('matakuliah.save');
Route::get('/mata-kuliah-edit/{id}', [MatakuliahController::class, 'edit'])->name('matakuliah.update');
Route::put('/mata-kuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.edit');
Route::delete('/mata-kuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.delete');

// Route::get      => Get Data     => R => select
// SELECT ALL   /   SELECT SPESIFIK
// Route::post     => Save Data    => C => insert into  /   create
// Route::put      => Update Data  => U => update  /   alter
// Route::delete   => Delete Data  => D => delete  /   drop

// Create, Read, Update, Delete