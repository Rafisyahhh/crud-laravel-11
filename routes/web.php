<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenismobilController;
use App\Http\Controllers\MerkmobilController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PengembalianController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth ::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(PenyewaanController::class)->group(function () {
    Route::get('/penyewaan', 'index')->name('penyewaan');
    Route::post('/penyewaan/tambah', 'store');
    Route::post('/penyewaan/ubah/{id}', 'update');
    Route::get('/penyewaan/hapus/{id}', 'destroy');
});
Route::controller(PengembalianController::class)->group(function () {
    Route::get('/pengembalian', 'index')->name('pengembalian');
    Route::post('/pengembalian/tambah', 'store');
    Route::post('/pengembalian/ubah/{id}', 'update');
    Route::get('/pengembalian/hapus/{id}', 'destroy');
});
Route::controller(KaryawanController::class)->group(function () {
    Route::get('/karyawan', 'index')->name('karyawan');
    Route::post('/karyawan/tambah', 'store');
    Route::post('/karyawan/ubah/{id}', 'update');
    Route::get('/karyawan/hapus/{id}', 'destroy');
});
Route::controller(PelangganController::class)->group(function () {
    Route::get('/pelanggan', 'index')->name('pelanggan');
    Route::post('/pelanggan/tambah', 'store');
    Route::post('/pelanggan/ubah/{id}', 'update');
    Route::get('/pelanggan/hapus/{id}', 'destroy');
});
Route::controller(MobilController::class)->group(function () {
    Route::get('/mobil', 'index')->name('mobil');
    Route::post('/mobil/tambah', 'store');
    Route::post('/mobil/ubah/{id}', 'update');
    Route::get('/mobil/hapus/{id}', 'destroy');
});
Route::controller(MerkmobilController::class)->group(function () {
    Route::get('/merkmobil', 'index')->name('merk');
    Route::post('/merkmobil/tambah', 'store');
    Route::post('/merkmobil/ubah/{id}', 'update');
    Route::get('/merkmobil/hapus/{id}', 'destroy');
});
Route::controller(JenismobilController::class)->group(function () {
    Route::get('/jenismobil', 'index')->name('jenis');
    Route::post('/jenismobil/tambah', 'store');
    Route::post('/jenismobil/ubah/{id}', 'update');
    Route::get('/jenismobil/hapus/{id}', 'destroy');
});
