<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;


class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'captcha.required' => 'Kode captcha wajib diisi.',
            'captcha.captcha' => 'Kode captcha yang dimasukkan tidak sesuai.',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Akun Tidak Ditemukan');
        }

        // Periksa status akun
        if ($user->status !== 'Aktif') {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Akun Tidak Aktif');
        }

        // Verifikasi password secara manual
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau Password Salah');
        }

        // Regenerate session
        Auth::login($user);

        $request->session()->regenerate();

        // Update informasi login
        $user->last_login = now();
        $user->last_ip = $request->ip();
        $user->save();

        return redirect()->intended('adm/dashboard');
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
