<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiSiswaController;


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

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/actionLogin', [AuthController::class, 'login'])->name('actionLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('actionLogout');

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->prefix('admin/murid')->name('admin.murid.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index'); // tampil semua siswa
    Route::get('/create', [AdminController::class, 'create'])->name('create'); // form tambah
    Route::post('/', [AdminController::class, 'store'])->name('store'); // simpan data baru
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit'); // form edit
    Route::put('/{id}', [AdminController::class, 'update'])->name('update'); // update data
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy'); // hapus data

    Route::get('/admin/murid/template', function () {   
        return response()->download(public_path('templates/template_siswa.xlsx'));
    })->name('template');
    Route::post('/admin/murid/import', [AdminController::class, 'import'])->name('import');
    Route::post('/admin/murid/bulk-update-status', [AdminController::class, 'bulkUpdateStatus'])->name('bulk-update-status');

    Route::get('/nilai/import', [NilaiSiswaController::class, 'showImportForm'])->name('nilai.import.form');
    Route::post('/nilai/import', [NilaiSiswaController::class, 'import'])->name('nilai.import');

    Route::get('/nilai', [NilaiSiswaController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/import', [NilaiSiswaController::class, 'showImportForm'])->name('nilai.import.form');
    Route::post('/nilai/import', [NilaiSiswaController::class, 'import'])->name('nilai.import');
});