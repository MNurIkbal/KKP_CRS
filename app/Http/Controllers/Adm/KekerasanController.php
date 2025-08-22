<?php



namespace App\Http\Controllers\Adm;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Kekerasan;





class KekerasanController extends Controller

{

    //

    public function __construct()

    {

        $this->pagetitle = "Jenis Kekerasan";

    }

    public function index()

    {

        $pagetitle = $this->pagetitle;

        $kekerasan = Kekerasan::orderby('tipe_kekerasan','asc')->get();

        return view('Admin.kekerasan.index', compact('kekerasan','pagetitle'));



    }



    public function create()

    {

        $pagetitle = $this->pagetitle;

        return view('Admin.kekerasan.create',compact('pagetitle'));

    }



    public function store(Request $request)

    {

         $request->validate([

            'tipe_kekerasan' => 'required',

        ]);



        $kekerasan = new Kekerasan();

        $kekerasan->tipe_kekerasan = $request->tipe_kekerasan;

        $kekerasan->save();



        return redirect()->route('kekerasan.index')

            ->with('success', 'Berhasil menambah data');

    }



   

    public function show($id)

    {

        //

    }



    

    public function edit(Kekerasan $kekerasan)

    {

        $pagetitle = $this->pagetitle;

        $kekerasan = Kekerasan::where('id',$kekerasan->id)->firstorFail();

        return view('Admin.kekerasan.edit', compact('kekerasan','pagetitle'));

    }



    public function update(Request $request,  Kekerasan $kekerasan)

    {

       $request->validate([

            'tipe_kekerasan' => 'required',

        ]);

        $kekerasan = Kekerasan::where('id',$kekerasan->id)->firstorFail();



        $kekerasan->tipe_kekerasan = $request->tipe_kekerasan;



        $kekerasan->save();



        return redirect()->route('kekerasan.index')

            ->with('success', 'Berhasil mengubah data');



    }



    

    public function destroy(kekerasan $kekerasan)

    {

        $kekerasan->delete();

        return redirect()->route('kekerasan.index')

            ->with('success', 'Data Berhasil Dihapus');

    }

}

