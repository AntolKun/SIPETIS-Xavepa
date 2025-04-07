<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('user')->get();
        return view('admin.murid.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.murid.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:users,nisn',
            'nama' => 'required',
            'kelas' => 'required',
            'status_bayar' => 'required|in:sudah,belum'
        ]);

        $user = User::create([
            'nisn' => $request->nisn,
            'password' => Hash::make('password'),
            'role' => 'murid'
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'status_bayar' => $request->status_bayar
        ]);

        return redirect()->route('admin.murid.index')->with('success', 'Murid berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('admin.murid.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'nisn' => 'required|unique:users,nisn,' . $user->id,
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'status_bayar' => 'required|in:sudah,belum',
        ]);

        $user->update([
            'nisn' => $request->nisn,
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'status_bayar' => $request->status_bayar,
        ]);

        return redirect()->route('admin.murid.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user->delete(); // sekaligus hapus user
        $siswa->delete();

        return redirect()->route('admin.murid.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('excel');
        $data = Excel::toArray([], $file);

        $rows = $data[0]; // ambil sheet pertama

        foreach ($rows as $key => $row) {
            if ($key == 0) continue; // skip header

            $nisn = $row[0];
            $nama = $row[1];
            $kelas = $row[2];
            $status = $row[3];

            // Cek duplikat
            if (!User::where('nisn', $nisn)->exists()) {
                $user = User::create([
                    'nisn' => $nisn,
                    'password' => Hash::make('password'),
                    'role' => 'murid'
                ]);

                Siswa::create([
                    'user_id' => $user->id,
                    'nama' => $nama,
                    'kelas' => $kelas,
                    'status_bayar' => $status
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data murid berhasil diimport.');
    }

    public function bulkUpdateStatus(Request $request)
    {
        $ids = json_decode($request->murid_ids, true);
        $status = $request->status;

        if (!$ids || !$status) {
            return back()->with('error', 'Pilih murid dan status terlebih dahulu.');
        }

        Siswa::whereIn('id', $ids)->update(['status_bayar' => $status]);

        return back()->with('success', 'Status berhasil diperbarui!');
    }
}


