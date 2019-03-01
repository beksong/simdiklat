<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Institution;

class InstitutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('lembaga.lembaga');
    }

    public function save(Request $req)
    {
        if ($req!==null) {

            $Institution = new Institution(array(
                'name' => $req->get('name'),
                'slug' => str_slug($req->get('name'))
            ));   
            $Institution->save();

            return redirect()->back()->with('message','Berhasil menyimpan data Lembaga ');
        }
    }

    public function edit(Request $req,$slug)
    {
        if($req==null){
            return redirect()->back()->with('message','Gagal menyimpan data');
        }

        $Institution=Institution::where('slug',$slug)->firstOrFail();
        $Institution->update([
            'name' => $req->get('lembaga'),
            'slug' => str_slug($req->get('lembaga'))
        ]);

        return redirect()->back()->with('message','Berhasil menyimpan data');
    }

    public function delete($slug)
    {
        $Institution = Institution::where('slug',$slug)->firstOrFail();

        if($Institution==null){
            return redirect()->back()->with('message','Gagal menghapus');
        }

        $Institution->delete();
        return redirect()->back()->with('message','Berhasil menghapus data');
    }

    public function getInstitutions()
    {
        $lembagas=Institution::all();
        return DataTables::of($lembagas)
        ->addColumn('action',function($lembaga){
            return view('lembaga.tbbutton',compact('lembaga'));
        })->make(true);
    }

    public function getLikeInstitution(Request $req)
    {
        $name = trim($req->get('q'));
        $institutions=Institution::where('name','like',"%{$name}%")->get();
        return json_decode($institutions);
    }
}
