<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ], [
            'email.required' => 'Alamat email wajib diisi.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',

            'captcha.required' => 'Kode captcha wajib diisi.',
            'captcha.captcha' => 'Kode captcha yang dimasukkan tidak sesuai.',
        ]);


        $kredensil = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($kredensil, $remember)) {
            $check  = User::where('email', $request->input('email'))->first();
            if ($check->status == "Aktif") {
                $user = Auth::user();
                User::where('email', $request['email'])->update(['last_login' => now(), 'last_ip' => $request->ip()]);
                return Redirect()->intended('adm/dashboard');
            } else {
                return redirect()->to('login')->with('error', 'Akun Tidak Aktif');
            }
        }

        return redirect()->to('login')->with('error', 'Akun Tidak Ditemukan');
    }



    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
