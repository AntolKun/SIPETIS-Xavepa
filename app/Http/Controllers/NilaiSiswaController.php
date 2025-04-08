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
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new NilaiSiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data nilai berhasil diimpor!');
    }

    public function index()
    {
        $nilaiList = NilaiSiswa::with(['siswa.user'])->get();

        return view('admin.nilai.index', compact('nilaiList'));
    }
}
