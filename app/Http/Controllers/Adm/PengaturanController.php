<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\PengaturanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()

    {
        $this->pagetitle = "Pengaturan";
        $this->folder_pengaturan = "uploads/folder_pengaturan/";
    }
    public function index()
    {
        $pagetitle = $this->pagetitle;

        // Pastikan kolom aes_algorithm ada di tabel pengaturan
        if (!\Illuminate\Support\Facades\Schema::hasColumn('pengaturan', 'aes_algorithm')) {
            try {
                \Illuminate\Support\Facades\Schema::table('pengaturan', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->string('aes_algorithm', 20)->default('AES-128')->after('informasi');
                });
            } catch (\Exception $e) {}
        }

        $pengaturan = PengaturanModel::orderby('id', 'DESC')->first();
        if ($pengaturan && empty($pengaturan->aes_algorithm)) {
            $pengaturan->aes_algorithm = 'AES-128';
            $pengaturan->save();
        }

        return view('Admin.pengaturan.index', compact('pengaturan', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'ig'        => 'required',
            'no_wa'     => 'required',
            'maps'      => 'required',
            'alamat'    => 'required',
            'informasi' => 'required',
            'file'      => 'mimes:pdf|max:2024',
            'email'     => 'required|email',
        ], [
            'ig.required' => 'Akun Instagram wajib diisi.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'maps.required' => 'Link Google Maps wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'informasi.required' => 'Informasi wajib diisi.',
            'file.mimes' => 'File harus berupa PDF.',
            'file.max' => 'Ukuran file maksimal 2MB.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);


        if ($request->file('file')) {
            $file = $request->file('file');
            $nowTimestamp = now()->timestamp;
            $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";
            $file->move($this->folder_pengaturan, $fileName);
            $file_manual = $this->folder_pengaturan . $fileName;
        }

        // Pastikan kolom aes_algorithm ada di tabel pengaturan
        if (!\Illuminate\Support\Facades\Schema::hasColumn('pengaturan', 'aes_algorithm')) {
            try {
                \Illuminate\Support\Facades\Schema::table('pengaturan', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->string('aes_algorithm', 20)->default('AES-128')->after('informasi');
                });
            } catch (\Exception $e) {}
        }

        $aesAlgorithm = $request->input('aes_algorithm', 'AES-128');
        if (!in_array($aesAlgorithm, ['AES-128', 'AES-256'])) {
            $aesAlgorithm = 'AES-128';
        }

        if ($request->file('file')) {
            PengaturanModel::orderby('id', 'DESC')->update([
                'manual_book'   =>  $file_manual,
                'nama'  =>  "Swyc",
                'maps'  =>  $request->input('maps'),
                'alamat'    =>  $request->input('alamat'),
                'no_wa' =>  $request->input('no_wa'),
                'ig'    =>  $request->input('ig'),
                'email' =>  $request->input('email'),
                'informasi' =>  $request->input('informasi'),
                'aes_algorithm' =>  $aesAlgorithm,
                'updated_at'    =>  Carbon::now()
            ]);
        } else {
            PengaturanModel::orderby('id', 'DESC')->update([
                'nama'  =>  "Swyc",
                'maps'  =>  $request->input('maps'),
                'alamat'    =>  $request->input('alamat'),
                'no_wa' =>  $request->input('no_wa'),
                'ig'    =>  $request->input('ig'),
                'email' =>  $request->input('email'),
                'informasi' =>  $request->input('informasi'),
                'aes_algorithm' =>  $aesAlgorithm,
                'updated_at'    =>  Carbon::now()
            ]);
        }


        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
