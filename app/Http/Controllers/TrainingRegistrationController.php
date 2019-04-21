<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Training;
use App\Participant;
use DataTables;
use Storage;

use App\Http\Requests\RegisterTrainingRequest;

class TrainingRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('trainingregistration.index');
    }

    public function getTrainingsForRegistration()
    {
        $now = Carbon::now();
        $trainings = Training::where('start_date','>',$now)->orderBy('start_date','asc')->get();
        return DataTables::of($trainings)
        ->addColumn('action',function($training){
            // here is many participants
            $participants = $training->participants;
            // eagerloading where match user_id
            $participant=$participants->firstWhere('user_id',\Auth::user()->id);
            if($participant!=null){
                // user exist as participants in training they just see print button
                // $participant = $training->participants()->where('user_id',\Auth::user()->id)->get();
                // return $participant;
                return view('trainingregistration.tbprint_registrationform',compact('training','participant'));
            }else{
                return view('trainingregistration.tbbutton',compact('training'));
            }
        })->addColumn('opendate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->rawColumns(['action','opendate'])->toJson();
    }

    // handle participants registration here
    public function register($slug,$training_id)
    {
        $training = Training::find($training_id);
        $participants = $training->participants;
        $participant = $participants->firstWhere('user_id',\Auth::user()->id);
        return view('trainingregistration.register',compact('training','participant'));
    } 

    public function store(RegisterTrainingRequest $request)
    {
        $storage = Storage::disk('requirement');
        $file = $request->file('requirements');
        $filename=preg_replace('/\s+/','_',$file->getClientOriginalName());
        $participant = new Participant(array(
            'user_id' => \Auth::user()->id,
            'phone' => $request->get('phone'),
            'training_id' => $request->get('training_id'),
            'frontdegree' => $request->get('frontdegree'),
            'backdegree' => $request->get('backdegree'),
            'fullname' => strtoupper($request->get('fullname')),
            'rank' => $request->get('rank'), //pangkat,golru
            'position' => $request->get('position'),//jabatan
            'institution' => $request->get('institution'), //institusi asal
            'institution_address' => $request->get('institution_address'),
            'institution_phone' => $request->get('institution_phone'),
            'requirements' => $filename
        ));

        $participant->save();
        $storage->put($filename,file_get_contents($file));

        return redirect('training/openregistration')->with('message','Berhasil Mendaftar');
    }

    public function update(RegisterTrainingRequest $request)
    {
        $participant = Participant::where('user_id',\Auth::user()->id)->firstOrFail();
        $storage = Storage::disk('requirement');
        $file = $request->file('requirements');
        //delete old file
        if(!empty($file)){
            $filename=preg_replace('/\s+/','_',$file->getClientOriginalName());
            if ($participant->requirements!='') {
                $storage->delete($participant->requirements);

                //update data
                $participant->update([
                    'phone' => $request->get('phone'),
                    'training_id' => $request->get('training_id'),
                    'frontdegree' => $request->get('frontdegree'),
                    'backdegree' => $request->get('backdegree'),
                    'fullname' => $request->get('fullname'),
                    'rank' => $request->get('rank'), //pangkat,golru
                    'position' => $request->get('position'),//jabatan
                    'institution' => $request->get('institution'), //institusi asal
                    'institution_address' => $request->get('institution_address'),
                    'institution_phone' => $request->get('institution_phone'),
                    'requirements' => $filename
                ]);
            }else{
                //update data
                $participant->update([
                    'phone' => $request->get('phone'),
                    'training_id' => $request->get('training_id'),
                    'frontdegree' => $request->get('frontdegree'),
                    'backdegree' => $request->get('backdegree'),
                    'fullname' => $request->get('fullname'),
                    'rank' => $request->get('rank'), //pangkat,golru
                    'position' => $request->get('position'),//jabatan
                    'institution' => $request->get('institution'), //institusi asal
                    'institution_address' => $request->get('institution_address'),
                    'institution_phone' => $request->get('institution_phone'),
                    'requirements' => $filename
                ]);
            }
            $storage->put($filename,file_get_contents($file));
        }else{
            //update data
            $participant->update([
                'phone' => $request->get('phone'),
                'training_id' => $request->get('training_id'),
                'frontdegree' => $request->get('frontdegree'),
                'backdegree' => $request->get('backdegree'),
                'fullname' => $request->get('fullname'),
                'rank' => $request->get('rank'), //pangkat,golru
                'position' => $request->get('position'),//jabatan
                'institution' => $request->get('institution'), //institusi asal
                'institution_address' => $request->get('institution_address'),
                'institution_phone' => $request->get('institution_phone'),
            ]);
        }
        return redirect('training/openregistration')->with('message','Berhasil merubah data');
    }

    public function printregistration($id)
    {
        $participant = Participant::find($id);
        return view('report.registration.registration',compact('participant'));
    }

    // user as participant in training and training
    public function asparticipant()
    {
        $participant = Participant::with(['training' => function($query){
            $query->where('end_date','>',Carbon::now()->addDays(-30));
        }])->where('user_id',\Auth::user()->id)->firstOrFail();
        return view('trainingregistration.asparticipant',compact('participant'));
    }

    public function participanthistory()
    {
        return view('traininghistory.index');
    }

    public function getparticipanthistory()
    {
        $participants = Participant::with('training')->where('user_id',\Auth::user()->id)->get();
        return DataTables::of($participants)
        ->addColumn('abstractfile',function($participant){
            if($participant->properabstract=='belum ada data'){
                return 'belum ada data silahkan upload abstract <a href="training/asparticipant">disini</a>';
            }else{
                return '<a href="storage/proper/'.$participant->properabstract.'">'.$participant->properabstract.'</a>';
            }
        })
        ->addColumn('docsfile',function($participant){
            if ($participant->properdocs=='belum ada data') {
                return 'belum ada data silahkan upload dokumen proper <a href="training/asparticipant">disini</a>';
            } else {
                return '<a href="storage/proper/'.$participant->properdocs.'">'.$participant->properdocs.'</a>';
            }
        })->addColumn('starting_date',function($participant){
            return Carbon::parse($participant->training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($participant){
            return Carbon::parse($participant->training->end_date)->format('d-m-Y');
        })->rawColumns(['abstractfile','docsfile','starting_date','enddate'])->toJson();
    }

    // as participant upload proper documents
    public function participantproper(Request $request)
    {
        //return $request->file('properdocs');
        $storage = Storage::disk('proper');
        $properdocs = $request->file('properdocs');
        $properabstract = $request->file('properabstract');

        $participant = Participant::find($request->get('participant_id'));

        if(!empty($properdocs)){
            //delete old file
            $storage->delete($participant->properdocs);
            //update and upload file
            $properdocsname=preg_replace('/\s+/','_',$properdocs->getClientOriginalName());
            $participant->update([
                'propername' => $request->get('propername'),
                'properdocs' => $properdocsname,
                'slug' => str_slug($request->get('propername'))
            ]);

            $storage->put($properdocsname,file_get_contents($properdocs));
        }

        if(!empty($properabstract)){
            //delete old file first
            $storage->delete($participant->properabstract);
            //update and upload file
            $properabstractname=preg_replace('/\s+/','_',$properabstract->getClientOriginalName());
            $participant->update([
                'properabstract'=>$properabstractname
            ]);
            $storage->put($properabstractname,file_get_contents($properabstract));
        }        

        return redirect()->back()->with('message','Berhasil Menyimpan Data');
    }
}
