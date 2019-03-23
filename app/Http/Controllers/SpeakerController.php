<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speaker;
use DataTables;

class SpeakerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('speaker.index');
    }

    public function getSpeakers()
    {
        $speakers = Speaker::with('user','subject')->get();
        return DataTables::of($speakers)
        ->addColumn('action',function($speaker){
            return view('speaker.tbbutton',compact('speaker'));
        })->make(true); 
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'subject_name' => 'required'
        ]);

        $speaker=new Speaker(array(
            'user_id' => $request->get('name'),
            'subject_id' => $request->get('subject_name')
        ));

        $speaker->save();

        return redirect()->back()->with('message','Data telah disimpan');
    }

    public function edit(Request $request)
    {
        $data = $request->validate([
            'speaker_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required'
        ]);

        $speaker = Speaker::find($request->get('speaker_id'));
        $speaker->update([
            'user_id' => $request->get('user_id'),
            'subject_id' => $request->get('subject_id')
        ]);

        return redirect()->back()->with('message','Data telah dirubah');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'speaker_id' => 'required'
        ]);

        $speaker = Speaker::find($request->get('speaker_id'));
        $speaker->delete();
        return redirect()->back()->with('message','Berhasil menghapus data');
    }

    public function getSubjectById(Request $req)
    {
        $speaker = Speaker::with('subject')->where('user_id',$req->get('q'))->get();
        return json_decode($speaker);
    }
}
