<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Universitas;


class UniversitasController extends Controller
{
    //
    public function __construct()
    {
        $this->pagetitle = "Universitas";
    }
    
    public function index()
    {
        $pagetitle = $this->pagetitle;
        $universitas = Universitas::orderby('nama','asc')->get();
        return view('Admin.universitas.index', compact('universitas','pagetitle'));

    }

    public function create()
    {
        $pagetitle = $this->pagetitle;
        return view('Admin.universitas.create',compact('pagetitle'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'nama' => 'required',
        ]);

        $universitas = new Universitas();
        $universitas->nama = $request->nama;
        $universitas->alamat = $request->alamat;
        $universitas->save();

        return redirect()->route('universitas.index')
            ->with('success', 'Berhasil menambah data');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Universitas $universita)
    {
        $pagetitle = $this->pagetitle;
        return view('Admin.universitas.edit', compact('universita','pagetitle'));
    }

    public function update(Request $request,  Universitas $universita)
    {

       $request->validate([
            'nama' => 'required',
        ]);
      
        $universita->nama = $request->nama;
        $universita->alamat = $request->alamat;
        $universita->save();

        return redirect()->route('universitas.index')
            ->with('success', 'Berhasil mengubah data');

    }

    
    public function destroy(Universitas $universita)
    {
        $universita->delete();
        return redirect()->route('kekerasan.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
