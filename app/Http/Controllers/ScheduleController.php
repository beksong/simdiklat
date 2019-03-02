<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use App\Detailschedule;
use DataTables;
use Carbon\Carbon;
use Grei\TanggalMerah;
use App\MasterSchedule;
use App\Http\Requests\MasterScheduleRequest;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedule.index');
    }

    public function getScheduleByTrainingId($id)
    {
        $training=Training::find($id);
        return view('schedule.masterschedules',compact('training'));
    }

    public function store(MasterScheduleRequest $request)
    {
        # store master schedule
        $master= new MasterSchedule(array(
            'training_id' => $request->get('training_id'),
            'type' => $request->get('typeschedule'),
            'nameschedulemaster' => $request->get('nameschedule')
        ));

        $master->save();
        return redirect()->back()->with('message','Data telah disimpan');
    }

    public function update(MasterScheduleRequest $request)
    {
        $schedule_id = $request->get('masterschedule_id');
        $mschedule = Masterschedule::find($schedule_id);
        $mschedule->update([
            'training_id' => $request->get('training_id'),
            'type' => $request->get('typeschedule'),
            'nameschedulemaster' => $request->get('nameschedule')
        ]);

        return redirect()->back()->with('message','Data telah diupdate');
    }

    public function delete(Request $request)
    {
        $mschedule = Masterschedule::find($request->get('masterschedule_id'));
        $mschedule->delete();
        return redirect()->back()->with('message','Data telah dihapus');
    }

    // datatables for masterschedules
    public function getschedulemasters(Request $request)
    {
        $training_id=$request->get('q');
        $masters = Masterschedule::with('training')->where('training_id',$training_id)->get();
        return DataTables::of($masters)
        ->addColumn('action',function($master){
            return view('schedule.tbbuttonmaster',compact('master'));
        })
        ->addColumn('detail',function($master){
           return view('schedule.tbbuttontodetail',compact('master')); 
        })
        ->addColumn('print',function($master){
            return '<a href="#" class="badge bg-blue"><i class="fa fa-print"></i></a>'; 
        })->rawColumns(['action','detail','print'])->toJson();
    }

    // detail schedules start here
    public function indexdetail($mschedule_id)
    {
        $mschedule = MasterSchedule::find($mschedule_id);
        return view('schedule.schedules',compact('mschedule'));
    }

    public function savedetail(ScheduleRequest $request)
    {
        $tanggal = Carbon::parse($request->get('dateschedule'));
        //check weekend
        if($tanggal->isWeekend()){
            return redirect()->back()->with('message','Hari Minggu tidak bisa dipilih sebagai hari diklat');
        }
        $isHoliday = new TanggalMerah();
        //check tanggal merah nasional 
        $isHoliday->set_date($tanggal);
        if($isHoliday->is_holiday()){
            return redirect()->back()->with('message','Hari Libur Nasional tidak bisa dipilih sebagai hari diklat');
        }
        // check if someone has a schedule on current session
        $schedule=Detailschedule::where('user_id',$request->get('user_id'))->where('sessionschedule',$request->get('sessionschedule'))->get();
        
        if($schedule->isEmpty()){
            // store data right here
            $schedule = new Detailschedule(array(
                'masterschedule_id' => $request->get('masterschedule_id'),
                'user_id' => $request->get('user_id'),
                'subject_id' => $request->get('subject_id'),
                'dateschedule' => $request->get('dateschedule'),
                'timeschedule' => $request->get('timeschedule'),
                'sessionschedule' => $request->get('sessionschedule'),
                'jp' => $request->get('jp'),
                'description' => $request->get('description')
            ));
    
            $schedule->save();
            return redirect('schedules/detailschedules/'.$schedule->masterschedule_id)->with('message','Berhasil menyimpan data');
        }

        // return if someone has a schedule on current data
        foreach($schedule as $sched){
            return redirect('schedules/detailschedules'.$sched->masterschedule_id)->with('message','Maaf beliau sedang mengajar di '.$sched->training->name.' pada tanggal '.$sched->dateschedule.' sesi ke : '.$sched->sessionschedule.' silahkan pilih tanggal lainnya');
        }
    }

    public function getschedules(Request $req)
    {
        // $training_id = $req->get('q');
        // $schedules=Schedule::with('user','subject')->where('training_id',$training_id)->orderBy('dateschedule','asc')->get();
        // return DataTables::of($schedules)
        // ->addColumn('action',function($schedule){
        //     return view('schedule.tbbutton',compact('schedule'));
        // })->toJson();
    }
}

