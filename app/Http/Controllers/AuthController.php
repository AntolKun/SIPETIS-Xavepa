<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nisn', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/admin/murid');
        }
        return redirect()->back()->withErrors(['NIS atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
