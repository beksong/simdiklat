<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Training;
use App\Pic;
use DataTables;
use Carbon\Carbon;
use Grei\TanggalMerah;
use App\Participant;
use PDF;

class TrainingController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        return view('training.index');
    }

    public function store(TrainingRequest $request)
    {
        $pic=\Auth::user()->pic()->get();
        if($pic->isEmpty()){
            return redirect()->back()->with('message','Anda Tidak Bukan PIC,tidak dapat menyimpan data');
        }
        $start_date=Carbon::parse($request->get('start_date'));
        //check weekend
        if($start_date->isWeekend()){
            return redirect()->back()->with('message','Hari Minggu tidak bisa dipilih sebagai hari pertama diklat');
        }
        
        $isHoliday = new TanggalMerah();
        //check tanggal merah nasional 
        $isHoliday->set_date($start_date);

        if($isHoliday->is_holiday()){
            return redirect()->back()->with('message','Hari Libur Nasional tidak bisa dipilih sebagai hari pertama diklat');
        }
        // loop mencari libur nasional dari period
        for ($i=0; $i < $request->get('period') ; $i++) {
            $end_date=$start_date->addDays(1);
            // check weekend
            if($end_date->isWeekend()){
                $end_date=$end_date->addDays(1);
            }
            // check hari libur nasional
            $isHoliday->set_date($end_date);
            if($isHoliday->is_holiday()){
                $end_date=$end_date->addDays(1);
            }
        }

        //return $request->all();
        $training = new Training(array(
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name')),
            'period' => $request->get('period'),
            'start_date' => $request->get('start_date'),
            'description' => $request->get('description'),
            'pic_id' => $pic[0]->id,
            'end_date' => $end_date
        ));
        
        $training->save();
        return redirect()->back()->with('message','Data telah disimpan');
    }

    public function edit(TrainingRequest $request)
    {
        $training = Training::find($request->get('training_id'));
        $start_date= Carbon::parse($request->get('start_date'));
        //check weekend
        if($start_date->isWeekend()){
            return redirect()->back()->with('message','Hari Minggu tidak bisa dipilih sebagai hari pertama diklat');
        }
        $isHoliday = new TanggalMerah();
        $isHoliday->set_date($start_date);
        if($isHoliday->is_holiday()){
            return redirect()->back()->with('message','Hari Libur Nasional tidak bisa dipilih sebagai hari pertama diklat');
        }
        // loop mencari libur nasional dari period
        for ($i=0; $i < $request->get('period') ; $i++) {
            $end_date=$start_date->addDays(1);
            // check weekend
            if($end_date->isWeekend()){
                $end_date=$end_date->addDays(1);
            }
            // check hari libur nasional
            $isHoliday->set_date($end_date);
            if($isHoliday->is_holiday()){
                $end_date=$end_date->addDays(1);
            }
        }
        $training->update([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name')),
            'period' => $request->get('period'),
            'start_date' => $request->get('start_date'), //we are not going update this one
            'description' => $request->get('description'),
            // 'pic_id' => $pic[0]->id, we are not going update the pic on update
            'end_date' => $end_date
        ]);

        return redirect()->back()->with('message','Data telah dirubah');
    }

    public function destroy(Request $request)
    {
        $training = Training::find($request->get('training_id'));
        $training->delete();

        return redirect()->back()->with('message','Data telah dihapus');
    }

    public function getTrainings()
    {
        $trainings=Training::with(['Pic'=>function($query){
            $query->with('Institution')->get();
        }])->orderBy('start_date','asc')->get();

        return DataTables::of($trainings)
        ->addColumn('schedule',function($training){
            return view('training.tbschedule',compact('training'));
        })->addColumn('printschedules',function($training){
            if($training->masterschedules->isEmpty()){
                return 'Belum Ada Jadwal';
            }else{
                return '<a href="printschedules/'.$training->id.'" class="badge bg-green"><i class="fa fa-print"></i> Print Jadwal</a>';
            }
        })->addColumn('action',function($training){
            return view('training.tbbutton',compact('training'));
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['printschedules','schedule','action','startingdate','enddate'])->toJson();
    }

    public function traininglist()
    {
        return view('training.opentraining.index');
    }

    public function getregisteredparticipants(Request $request)
    {
        $trainings = Training::with(['Pic'=>function($query){
            $query->with('Institution');
        }])->where('start_date','>',Carbon::now())->orWhere('end_date','>',Carbon::now(-7))->orderBy('start_date','asc')->get();
        
        return DataTables::of($trainings)
        ->addColumn('participant',function($training){
            return view('training.opentraining.tbbutton',compact('training'));
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['participant','startingdate','enddate'])->toJson();
    }

    // admin get registered participants
    public function showparticipants($training_id)
    {
        $training = Training::find($training_id);
        return view('training.opentraining.showparticipants',compact('training'));
    }

    // get allready registered participant for admin datatables
    public function getalreadyregisteredparticipants(Request $request)
    {
        $participants = Participant::with('user')->where('training_id',$request->get('q'))->get();
        return DataTables::of($participants)
        ->addColumn('requirementsdocs',function($participant){
            return '<a href="../../storage/requirement/'.$participant->requirements.'">'.$participant->requirements.'</a>';
        })
        ->addColumn('action',function($participant){
            return view('training.opentraining.tbbuttonparticipant',compact('participant'));
        })->rawColumns(['requirementsdocs','action'])->toJson();
    }

    // get trainings list for admin select2
    public function gettraininglist(Request $request)
    {
        $data = trim($request->get('q'));
        $trainings = Training::where('name','like',"%{$data}%")->get();
        return json_decode($trainings);
    }

    /**
     * here is where admin wanna enrole or giving role a participant to custom training
     * update participant from one training to others
     */
    public function updateparticipantbyadmin(Request $request)
    {
        $p = Participant::find($request->get('participant_id'));

        $p->update([
            'training_id' => $request->get('training_id')
        ]);

        return redirect()->back()->with('message','Berhasil merubah data');
    }

    public function deleteparticipantbyadmin(Request $request)
    {
        $p=Participant::find($request->get('participant_id'));
        $p->delete();
        return redirect()->back()->with('message','Berhasil menghapus data');
    }

    /**
     * here is admin print participant and create absent
     */
    public function printparticipantsbyadmin($training_id)
    {
        $training=Training::find($training_id);
        $participants = Participant::where('training_id',$training_id)->get();
        $pdf = PDF::loadView('report.training.participant-absen',compact('participants','training'));
        $pdf->setOrientation('portrait');
        //return $pdf->download('absen.pdf');
        return view('report.training.participant-absen',compact('participants','training'));
    }
    /**
     * here is admin export participant data into excel
     */
    public function exportparticipantsbyadmin($training_id)
    {
        $training=Training::find($training_id);
        $participants = Participant::where('training_id',$training_id)->get(); 
    }
}
