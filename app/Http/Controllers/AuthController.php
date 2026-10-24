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

    public function register()
    {
        return view('register');
    }

    public function proses_register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan login atau gunakan email lain.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'captcha.required' => 'Kode captcha wajib diisi.',
            'captcha.captcha' => 'Kode captcha yang dimasukkan tidak sesuai.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = strtolower(trim($request->email));
        $user->password = Hash::make($request->password);
        $user->level = 'pelapor';
        $user->status = 'Aktif';
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        $user->last_login = now();
        $user->last_ip = $request->ip();
        $user->save();

        // Jika ada redirect kembali ke pembuatan laporan
        if ($request->has('redirect_to') && $request->redirect_to === 'form_laporan') {
            return redirect()->to('laporan/form')->with('success', 'Registrasi berhasil! Silakan lengkapi formulir laporan Anda.');
        }

        return redirect()->to('adm/dashboard')->with('success', 'Registrasi berhasil! Selamat datang di Panel Pelapor.');
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
