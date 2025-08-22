<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->pagetitle = "Log";
        $this->level = array('superadmin' => 'Super Administrator', ' pt' => 'Admin Kampus');
    }
    public function index()
    {
        if(Auth::user()->level == "superadmin") {
            $result = AktifitasModel::orderby('id','DESC')->get();
        } else {
            $result = AktifitasModel::where('user_id',Auth::user()->id)->orderby('id','DESC')->get();
        }
        $pagetitle = $this->pagetitle;
        return view('Admin.log.index', compact('result', 'pagetitle'));
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
        $check = AktifitasModel::find($id);
        if(!$check) {
            return abort(404);
        }

        AktifitasModel::where('id',$id)->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
