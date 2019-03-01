<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use App\Schedule;
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

    // datatables for masterschedules
    public function getschedulemasters(Request $request)
    {
        $training_id=$request->get('q');
        $masters = Training::with('masterschedule')->where('training_id',$training_id)->get();
        return DataTables::of(masters)
        ->addColumn('action',function($master){
            
        })->toJson();
    }

    public function save(ScheduleRequest $request)
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
        // check if someone has a schedule on current date
        $schedule=Schedule::where('user_id',$request->get('user_id'))->where('sessionschedule',$request->get('sessionschedule'))->get();
        
        if($schedule->isEmpty()){
            // store data right here
            $schedule = new Schedule(array(
                'training_id' => $request->get('training_id'),
                'dateschedule' => $request->get('dateschedule'),
                'user_id' => $request->get('user_id'),
                'subject_id' => $request->get('subject_id'),
                'timeschedule' => $request->get('timeschedule'),
                'jp' => $request->get('jp'),
                'sessionschedule' => $request->get('sessionschedule'),
                'description' => $request->get('description')
            ));
    
            $schedule->save();
            return redirect('schedules/'.$schedule->training_id)->with('message','Berhasil menyimpan data');
        }

        // return if someone has a schedule on current data
        foreach($schedule as $sched){
            return redirect('schedules/'.$sched->training_id)->with('message','Maaf beliau sedang mengajar di '.$sched->training->name.' pada tanggal '.$sched->dateschedule.' sesi ke : '.$sched->sessionschedule.' silahkan pilih tanggal lainnya');
        }
    }

    public function getschedules(Request $req)
    {
        $training_id = $req->get('q');
        $schedules=Schedule::with('user','subject')->where('training_id',$training_id)->orderBy('dateschedule','asc')->get();
        return DataTables::of($schedules)
        ->addColumn('action',function($schedule){
            return view('schedule.tbbutton',compact('schedule'));
        })->toJson();
    }
}

