<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\KontakModel;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()

    {
        $this->pagetitle = "Saran Dan Masukan";
    }
    public function index()
    {

        $pagetitle = $this->pagetitle;

        $kontak = KontakModel::orderby('id', 'DESC')->get();

        return view('Admin.saran.index', compact('kontak', 'pagetitle'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = KontakModel::find($id);
        if (!$check) {
            return abort(404);
        }
        KontakModel::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
