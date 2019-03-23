<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Training;
use App\Participant;
use DataTables;

use App\Http\Requests\RegisterTrainingRequest;

class TrainingRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('trainingregistration.index',compact('trainings'));
    }

    public function getTrainingsForRegistration()
    {
        $now = Carbon::now();
        $trainings = Training::where('start_date','>',$now)->get();
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
        })->toJson();
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
        $participant = new Participant(array(
            'user_id' => \Auth::user()->id,
            'training_id' => $request->get('training_id'),
            'frontdegree' => $request->get('frontdegree'),
            'backdegree' => $request->get('backdegree'),
            'fullname' => $request->get('fullname'),
            'rank' => $request->get('rank'), //pangkat,golru
            'position' => $request->get('position'),//jabatan
            'institution' => $request->get('institution') //institusi asal
        ));

        $participant->save();
        return redirect('training/openregistration')->with('message','Berhasil Mendaftar');
    }

    public function update(RegisterTrainingRequest $request)
    {
        $participant = Participant::where('user_id',\Auth::user()->id)->firstOrFail();
        $participant->update([
            'training_id' => $request->get('training_id'),
            'frontdegree' => $request->get('frontdegree'),
            'backdegree' => $request->get('backdegree'),
            'fullname' => $request->get('fullname'),
            'rank' => $request->get('rank'), //pangkat,golru
            'position' => $request->get('position'),//jabatan
            'institution' => $request->get('institution') //institusi asal
        ]);
        return redirect('training/openregistration')->with('message','Berhasil merubah data');
    }

    public function printregistration($id)
    {
        $participant = Participant::find($id);
        return view('report.registration.registration',compact('participant'));
    }
}
