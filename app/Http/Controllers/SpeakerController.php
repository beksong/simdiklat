<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speaker;
use App\Detailschedule;
use DataTables;
use Carbon\Carbon;
use App\Training;
use App\Masterschedule;
use Storage;

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

    /**
     * speaker when wanna see the schedule or upload documents of subject
     */

     public function getmyschedule()
     {
         return view('speakergetschedule.index');
     }

    public function getmyscheduledetails()
    {
        $user = \Auth::user();
        $details = Detailschedule::with(['masterschedule'=>function($query){
            $query->with('training');
        },'subject'])->where('user_id',$user->id)->where('dateschedule','>=',Carbon::now())->orderBy('dateschedule','asc')->get();
        return DataTables::of($details)
        ->addColumn('datescheduleformat',function($detail){
            return Carbon::parse($detail->dateschedule)->format('d-m-Y');
        })->toJson();
    }

    /**
     *  uploading learning media here
     */

    public function learningmedia()
    {
        $user=\Auth::user();
        $details = Detailschedule::with(['masterschedule'=>function($query){
            $query->with('training');
        },'subject'])->where('user_id',$user->id)->where('dateschedule','>=',Carbon::now())->orderBy('dateschedule','asc')->get();

        $uniques=$details->unique(function($item){
            return $item['masterschedule_id'].$item['subject_id'];
        });
        
        return view('speakergetschedule.learningmedia');
        return DataTables::of($uniques)
        ->addColumn('rpbmd',function($unique){

        })->addColumn('learning_material',function($unique){

        })->addColumn('airing_material',function($unique){

        })->toJson();
    }

    public function getlearningmedia()
    {
        $user=\Auth::user();
        $details = Detailschedule::with(['masterschedule'=>function($query){
            $query->with('training');
        },'subject'])->where('user_id',$user->id)->where('dateschedule','>=',Carbon::now())->orderBy('dateschedule','asc')->get();

        $uniques=$details->unique(function($item){
            return $item['masterschedule_id'].$item['subject_id'];
        });

        return DataTables::of($uniques)
        ->addColumn('rpbmd',function($unique){
            if ($unique->rpbmd=='') {
                return 'Belum Ada Data Diupload';
            } else {
                return '<a href="storage/teaching_administrations/'.$unique->rpbmd.'">'.$unique->rpbmd.'</a>';
            }
        })->addColumn('teaching_material',function($unique){
            if ($unique->teaching_material=='') {
                return 'Belum Ada Data Diupload';
            } else {
                return '<a href="storage/teaching_administrations/'.$unique->teaching_material.'">'.$unique->teaching_material.'</a>';
            }
        })->addColumn('airing_material',function($unique){
            if ($unique->airing_material=='') {
                return 'Belum Ada Data Diupload';
            } else {
                return '<a href="storage/teaching_administrations/'.$unique->airing_material.'">'.$unique->airing_material.'</a>';
            }
        })->addColumn('action',function($unique){
            return '<a href="" data-toggle="modal" data-target="#teaching_administration" data-training="'.$unique->masterschedule->training->name.'" data-subject_name="'.$unique->subject->name.'" data-detailschedule_id="'.$unique->id.'"><i class="fa fa-cloud-upload"></i> Upload Dokumen</a>';
        })->rawColumns(['rpbmd','teaching_material','airing_material','action'])->toJson();
    }

    public function storelearningmedia(Request $request)
    {
        $storage = Storage::disk('teaching_administrations');
        $rpbmd = $request->file('rpbmd');
        $teaching_material = $request->file('teaching_material');
        $airing_material = $request->file('airing_material');

        $detailschedule = Detailschedule::find($request->get('detailschedule_id'));

        if(!empty($rpbmd)){
            if($detailschedule->rpbmd!==''){
                $storage->delete($detailschedule->rpbmd);  
            }
            $rpbmd_name=preg_replace('/\s+/','_',$rpbmd->getClientOriginalName());
            $detailschedule->update([
                'rpbmd' => $rpbmd_name,
            ]);
            $storage->put($rpbmd_name,file_get_contents($rpbmd));
        }

        if(!empty($teaching_material)){
            if($detailschedule->teaching_material!==''){
                $storage->delete($detailschedule->teaching_material); 
            }
            $teaching_material_name=preg_replace('/\s+/','_',$teaching_material->getClientOriginalName());
            $detailschedule->update([
                'teaching_material' => $teaching_material_name,
            ]);
            $storage->put($teaching_material_name,file_get_contents($teaching_material));
        }

        if(!empty($airing_material)){
            if($detailschedule->airing_material!=''){
                $storage->delete($detailschedule->airing_material);
            }
            $airing_material_name=preg_replace('/\s+/','_',$airing_material->getClientOriginalName());
            $detailschedule->update([
                'airing_material' => $airing_material_name,
            ]);
            $storage->put($airing_material_name,file_get_contents($airing_material));
        }

        return redirect()->back()->with('message','Berhasil Merubah Data');
    }
}
