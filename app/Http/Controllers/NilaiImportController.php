<?php

namespace App\Http\Controllers;
use App\Imports\NilaiSiswaImport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class NilaiImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new NilaiSiswaImport, $request->file('excel'));

        return redirect()->back()->with('success', 'Import nilai berhasil!');
    }
}
