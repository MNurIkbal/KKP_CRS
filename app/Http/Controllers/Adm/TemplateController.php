<?php



namespace App\Http\Controllers\Adm;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Template;





class TemplateController extends Controller

{

    //

    public function __construct()

    {

        $this->pagetitle = "Template Status";
    }

    public function index()

    {

        $pagetitle = $this->pagetitle;

        $template = Template::orderby('status', 'asc')->get();

        return view('Admin.template.index', compact('template', 'pagetitle'));
    }



    public function create()

    {

        $pagetitle = $this->pagetitle;

        return view('Admin.template.create', compact('pagetitle'));
    }



    public function store(Request $request)

    {

        $request->validate([

            'status' => 'required|unique:status_template,status',
            'deskripsi_status'  =>  'required'

        ], [
            'status.required'   =>  'Status Harus Diisi',
            'deskripsi_status.required' =>  'Deskripsi Harus Diisi',
            'status.unique' =>  'Status Sudah Ada'
        ]);



        $template = new Template();

        $template->status = $request->status;

        $template->deskripsi_status = $request->deskripsi_status;

        $template->save();



        return redirect()->route('template.index')

            ->with('success', 'Berhasil menambah data');
    }





    public function show($id)

    {

        //

    }





    public function edit(Template $template)

    {

        $pagetitle = $this->pagetitle;

        $template = Template::where('id', $template->id)->firstorFail();

        return view('Admin.template.edit', compact('template', 'pagetitle'));
    }



    public function update(Request $request,  Template $template)

    {

        $request->validate([

            'status' => 'required',
            'deskripsi_status'  =>  'required'

        ], [
            'status.required'   =>  'Status Harus Diisi',
            'deskripsi_status.required' =>  'Deskripsi Harus Diisi',
        ]);

        $template = Template::where('id', $template->id)->firstorFail();


        if (!in_array($request->input('status'), [
            "Selesai",
            "Laporan Di Tinjau Ulang",
            "Sedang diverifikasi",
            "Laporan tidak sesuai dengan tindak kekerasan"
        ])) {
            $template->status = $request->status;
        }

        $template->deskripsi_status = $request->deskripsi_status;

        $template->save();



        return redirect()->route('template.index')

            ->with('success', 'Berhasil mengubah data');
    }





    public function destroy(Template $template)

    {

        $template->delete();

        return redirect()->route('template.index')

            ->with('success', 'Data Berhasil Dihapus');
    }
}
