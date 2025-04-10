<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\NilaiSiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NilaiSiswa;


class NilaiSiswaController extends Controller
{
    public function showImportForm()
    {
        return view('nilai.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new NilaiSiswaImport, $request->file('file'));
            return redirect()->back()->with('success', 'Nilai berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->back()->with('error', 'Format file tidak sesuai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $nilaiList = NilaiSiswa::with(['siswa.user'])->get();

        return view('admin.nilai.index', compact('nilaiList'));
    }
}
