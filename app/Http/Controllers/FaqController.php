<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()

    {
        $this->pagetitle = "FAQ";
    }
    public function index()
    {

        $pagetitle = $this->pagetitle;

        $faq = FaqModel::orderby('id', 'DESC')->get();

        return view('Admin.faq.index', compact('faq', 'pagetitle'));
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
        $request->validate([
            'judul' =>  'required',
            'deskripsi' =>  'required'
        ]);

        FaqModel::create([
            'judul' =>  $request->input('judul'),
            'deskripsi' =>  $request->input('deskripsi'),
            'created_at'    =>  Carbon::now()
        ]);

        return redirect()->back()->with('success','Data Berhasil Ditambahkan');
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
    public function update(Request $request)
    {
        $request->validate([
            'judul' =>  'required',
            'deskripsi' =>  'required'
        ]);
        $id = $request->input('id');

        FaqModel::where('id',$id)->update([
            'judul' =>  $request->input('judul'),
            'deskripsi' =>  $request->input('deskripsi'),
            'updated_at'    =>  Carbon::now()
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        FaqModel::where('id',$request->input('id'))->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
