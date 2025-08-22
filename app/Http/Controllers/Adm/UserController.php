<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\User;
use App\Models\Universitas;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use App\Mail\UserCredentialsMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function __construct()
    {
        $this->pagetitle = "User";
        $this->level = array('superadmin' => 'Super Administrator', ' pt' => 'Admin Kampus');
    }
    public function index()
    {
        $users = User::get();
        $pagetitle = $this->pagetitle;
        return view('Admin.user.index', compact('users', 'pagetitle'));
    }

    public function gantipassword(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'password' => 'required|same:password_baru',
            'password_baru' => 'required'
        ], [
            'password.required' => 'Kata sandi wajib diisi.',
            'password.same' => 'Kata sandi dan konfirmasi tidak cocok.',
            'password_baru.required' => 'Konfirmasi kata sandi wajib diisi.',
        ]);

        $password = Hash::make($request->input('password'));
        User::where('id', $id)->update([
            'password' =>   $password,
            'updated_at'    =>  Carbon::now()
        ]);
        return redirect()->to('adm/dashboard')->with('success', 'Password Berhasil Diupdate');
    }

    public function create()
    {
        $pagetitle = $this->pagetitle;
        $level = $this->level;
        $universitas = Universitas::orderby('nama', 'asc')->get();
        return view('Admin.user.create', compact('level', 'pagetitle', 'universitas'));
    }

    public function gantiProfile(Request $request)
    {
        $request->validate([
            'nama'  =>  'required|max:255',
            'email' =>  'required|email|max:255'
        ]);

        $id = Auth::user()->id;
        User::where('id', $id)->update([
            'name'  =>  $request->input('nama'),
            'email' =>  $request->input('email'),
            'updated_at'    =>  Carbon::now()
        ]);

        return redirect()->to('adm/dashboard')->with("success", 'Data Berhasil Diupdate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',                        // Nama wajib diisi
            'level' => 'required',                       // Level wajib diisi
            'status' => 'required',                      // Status wajib diisi
            'email' => 'required|email|unique:users,email', // Email wajib diisi, harus format email yang valid, dan unik di tabel users
            'password' => [
                'required',                             // Password wajib diisi
                'confirmed',                           // Memastikan password dan konfirmasi password cocok
                Password::min(8)                       // Password minimal 8 karakter
                    ->letters()                        // Harus mengandung huruf
                    ->numbers(),                       // Harus mengandung angka
            ],
        ], [
            'name.required' =>  'Nama Harus Diisi',            // Pesan error jika nama tidak diisi
            'level.required' =>  'Level Harus Diisi',          // Pesan error jika level tidak diisi
            'status.required' =>  'Status Harus Diisi',        // Pesan error jika status tidak diisi
            'email.required' =>  'Email Harus Diisi',          // Pesan error jika email tidak diisi
            'email.email' =>  'Email Tidak Valid',             // Pesan error jika format email salah
            'email.unique' =>  'Email Sudah Ada',              // Pesan error jika email sudah terdaftar
            'password.required' =>  'Password Harus Diisi',    // Pesan error jika password tidak diisi
            'password.confirmed' =>  'Password Tidak Sama'     // Pesan error jika konfirmasi password tidak cocok
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->universitas_id = $request->universitas;
        $user->password = bcrypt($request->password);
        $user->status   = $request->status;
        $user->save();

        //kirim email
        Mail::to($user->email)->send(new UserCredentialsMail($user->email, $request->password));


        return redirect()->route('user.index')
            ->with('success', 'Berhasil menambah data');
    }

    public function update_profile() {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagetitle = $this->pagetitle;
        $roles = $this->level;
        $useredit = User::where('id', $id)->firstorFail();
        return view('Admin.user.edit', compact('useredit', 'roles', 'pagetitle'));
    }

    public function update(Request $request, User $user)
    {
        $validator = [
            'name' => 'required',
            'status'    =>  'required',
            'email' => 'required|email',
        ];

        if (trim($request->password) != "") {
            $validator['password'] = 'required|confirmed';
        }

        $request->validate($validator);

        $user->name = $request->name;
        $user->email = $request->email;
        if (trim($request->password) != "") {
            $user->password = bcrypt($request->password);
        }
        $user->status = $request->input('status');

        $user->update();

        return redirect()->route('user.index')
            ->with('success', 'Berhasil mengubah data');
    }


    public function destroy(User $user)
    {
        // die(print_r($user));
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
