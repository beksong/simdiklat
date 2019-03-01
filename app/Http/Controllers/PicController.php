<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pic;
use App\Institution;
use DataTables;

class PicController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pic.pic');
    }

    public function getUser(Request $req)
    {
        $nama = trim($req->get('q'));
        $users = User::where('name','like',"%{$nama}%")->orWhere('nip','like',"%{$nama}%")->get();
        return json_decode($users);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'institution_name' => 'required'
        ]);

        if ($data) {
            Pic::create([
                'user_id' => $req->get('name'),
                'institution_id' => $req->get('institution_name')
            ]);
            return redirect()->back()->with('message','Data telah tersimpan');
        }

        return redirect()->back()->with('message','Gagal Menyimpan');
    }

    public function getPics()
    {
        $pics = Pic::with('User','Institution')->get();
        return DataTables::of($pics)
        ->addColumn('action',function($pic){
            return view('pic.tbbutton',compact('pic'));
        })->make(true);
    }

    public function update(Request $req,$id)
    {
        $pic=Pic::find($id);
        $req->validate([
            'user_id' => 'required',
            'institution_id' => 'required'
        ]);

        $pic->update([
            'user_id' => $req->get('user_id'),
            'institution_id' => $req->get('institution_id')
        ]);

        return redirect()->back()->with('message','sukses merubah data');
    }

    public function delete($id)
    {
        $pic=Pic::find($id);
        $pic->delete();

        return redirect()->back()->with('message','sukses menghapus data');
    }
}
