<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\NilaiSiswa;

class SiswaController extends Controller
{
  public function updatePassword(Request $request)
  {
    $request->validate([
      'current_password' => ['required'],
      'new_password' => ['required', 'confirmed', 'min:6'],
    ]);

    $user = User::find(Auth::id()); // ambil ulang dengan model User

    if (!Hash::check($request->current_password, $user->password)) {
      return back()->with('error', 'Password lama salah!');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password berhasil diubah.');
  }

  public function downloadNilai()
  {
    $user = auth()->user();

    $siswa = $user->siswa;

    if (!$siswa) {
      return back()->with('error', 'Data siswa tidak ditemukan.');
    }

    if ($siswa->status_bayar !== 'sudah') {
      return back()->with('error', 'Anda belum melakukan pembayaran.');
    }

    $nilai = $siswa->nilai;

    if (!$nilai) {
      return back()->with('error', 'Nilai belum tersedia.');
    }

    $pdf = Pdf::loadView('siswa.nilai_pdf', [
      'siswa' => $siswa,
      'nilai' => $nilai
    ]);

    return $pdf->download('nilai-' . $siswa->nama . '.pdf');
  }
}
