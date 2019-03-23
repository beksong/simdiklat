<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('matadiklat.matadiklat');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string'
        ]);

        $md = new Subject(array(
            'name' => $req->get('name'),
            'slug' => str_slug($req->get('name'))
        ));

        $md->save();
        return redirect()->back()->with('message','Berhasil menyimpan data');
    }

    public function getSubjects()
    {
        $subs = Subject::all();
        return DataTables::of($subs)
        ->addColumn('action',function($sub){
        return view('matadiklat.tbbutton',compact('sub'));
        })->make(true);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'subject_id' => 'required|Integer'
        ]);

        $sub = Subject::find($request->get('subject_id'));
        $sub->update([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name'))
        ]);

        return redirect()->back()->with('message','Berhasil Merubah Data');
    }

    public function destroy(Request $request)
    {
        $sub = Subject::find($request->get('subject_id'));
        $sub->delete();
        return redirect()->back()->with('message','Berhasil Menghapus Data');
    }

    public function getlikesubject(Request $req)
    {
        $subject = trim($req->get('q'));
        $subjects = Subject::where('name','like',"%{$subject}%")->get();
        return json_decode($subjects);
    }
}
