<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DokumenIdentitas;


class IdentitasController extends Controller
{
    //
    public function __construct()
    {
        $this->pagetitle = "Jenis Identitas";
    }
    
    public function index()
    {
        $pagetitle = $this->pagetitle;
        $identitas = DokumenIdentitas::orderby('jenis_identitas','asc')->get();
        return view('Admin.identitas.index', compact('identitas','pagetitle'));

    }

    public function create()
    {
        $pagetitle = $this->pagetitle;
        return view('Admin.identitas.create',compact('pagetitle'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'jenis_identitas' => 'required',
        ]);

        $identitas = new DokumenIdentitas();
        $identitas->jenis_identitas = $request->jenis_identitas;
        $identitas->save();

        return redirect()->route('identitas.index')
            ->with('success', 'Berhasil menambah data');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(DokumenIdentitas $identita)
    {
        $pagetitle = $this->pagetitle;
        //$identita = DokumenIdentitas::where('id',$identita->id)->firstorFail();
        return view('Admin.identitas.edit', compact('identita','pagetitle'));
    }

    public function update(Request $request,  DokumenIdentitas $identita)
    {
       $request->validate([
            'jenis_identitas' => 'required',
        ]);
       // $identitas = DokumenIdentitas::where('id',$identitas->id)->firstorFail();

        $identita->jenis_identitas = $request->jenis_identitas;
        $identita->save();

        return redirect()->route('identitas.index')
            ->with('success', 'Berhasil mengubah data');

    }

    
    public function destroy(DokumenIdentitas $identita)
    {
        $identita->delete();
        return redirect()->route('identitas.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
