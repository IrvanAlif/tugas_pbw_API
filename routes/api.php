<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\NilaiController;

// Studi Kasus 1: CRUD Mahasiswa
Route::apiResource('mahasiswas', MahasiswaController::class);

// Studi Kasus 2: Nilai Mahasiswa
Route::apiResource('nilais', NilaiController::class);

// Route khusus: ambil nilai per mahasiswa (relasi antar tabel)
Route::get('mahasiswas/{id}/nilais', [NilaiController::class, 'byMahasiswa']);
