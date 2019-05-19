<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use DataTables;
use Carbon\Carbon;
class AdminBkpsdmController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth','admin-bkpsdm');
    }

    public function index()
    {
        return view('adminbkpsdm.index');
    }

    public function gettrainingbkpsdm()
    {
        $id = \Auth::user()->pic()->firstOrFail();
        $trainings = Training::where('pic_id',$id->id)->orderBy('start_date','asc')->get();

        return DataTables::of($trainings)
        ->addColumn('action',function($training){
            return view('adminbkpsdm.tbbutton',compact('training'));
        })->addColumn('printschedules',function($training){
            if($training->masterschedules->isEmpty()){
                return 'Belum Ada Jadwal';
            }else{
                return '<a href="printschedules/'.$training->id.'" class="badge bg-green"><i class="fa fa-print"></i> Print Jadwal</a>';
            }
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['printschedules','action','startingdate','enddate'])->toJson();
    }

    /**
     * management participant of bkpsdm
     */
    public function traininglistbkpsdm()
    {
        return view('adminbkpsdm.participantmanagement.index');
    }

    public function getregisteredparticipantbkpsdm()
    {
        $id = \Auth::user()->pic()->firstOrFail();
        $trainings = Training::where('pic_id',$id->id)->where('start_date','<',Carbon::now())->Where('end_date','>',Carbon::now(-7))->orderBy('start_date','asc')->get();
        
        return DataTables::of($trainings)
        ->addColumn('participant',function($training){
            return view('training.opentraining.tbbutton',compact('training'));
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['participant','startingdate','enddate'])->toJson();
    }
}
