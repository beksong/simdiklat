<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use App\Detailschedule;
use App\Masterschedule;
use App\Printedschedule;
use App\Subject;
use App\User;
use DataTables;
use Carbon\Carbon;
use Grei\TanggalMerah;
use App\Http\Requests\MasterScheduleRequest;
use App\Http\Requests\ScheduleRequest;
use PDF;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
            return '<a href="detailschedules/print/'.$master->type.'/'.$master->id.'" class="badge bg-blue"><i class="fa fa-print"></i></a>'; 
        })->rawColumns(['action','detail','print'])->toJson();
    }

    /**
     * detail schedules start here
     * 
     */
    
    public function indexdetail($type,$mschedule_id)
    {
        $mschedule = MasterSchedule::where('type',$type)->where('id',$mschedule_id)->firstOrFail();
        return view('schedule.schedules',compact('mschedule'));
    }

    public function savedetail(ScheduleRequest $request)
    {
        // check if dateschedule that being registered are still on range of training date
        $masterschedule = Masterschedule::find($request->get('masterschedule_id'));
        $training = Training::find($masterschedule->training_id);

        $tanggal = Carbon::parse($request->get('dateschedule'));
        if( $tanggal < $training->start_date){
            return redirect()->back()->with('message','Tanggal jadwal tidak boleh lebih kecil dari tanggal awal diklat');
        }

        if($tanggal > $training->end_date){
            return redirect()->back()->with('message','Tanggal jadwal tidak boleh melewati tanggal penutupan diklat');
        }

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
        $schedule=Detailschedule::where('user_id',$request->get('user_id'))->where('dateschedule',$request->get('dateschedule'))->where('sessionschedule',$request->get('sessionschedule'))->get();
        //return $schedule;
        if($schedule->isEmpty()){
            // store data right here
            if($request->get('toprint')==1){
                $uniqueschedule = str_random('10').'_'.str_random('10');
            }else{
                $uniqueschedule ='';
            }

            $schedule = new Detailschedule(array(
                'masterschedule_id' => $request->get('masterschedule_id'),
                'user_id' => $request->get('user_id'),
                'subject_id' => $request->get('subject_id'),
                'dateschedule' => $request->get('dateschedule'),
                'timeschedule' => $request->get('timeschedule'),
                'sessionschedule' => $request->get('sessionschedule'),
                'jp' => $request->get('jp'),
                'uniqueschedule' => $uniqueschedule,
                'description' => $request->get('description')
            ));
    
            $schedule->save();
            // if users check option printed to schedule this code will work
            // and will save to printedschedules tables
            if($request->get('toprint')==1){
                $subject = Subject::find($schedule->subject_id);
                $speaker = User::find($schedule->user_id);

                $printedschedule = new Printedschedule(array(
                    'masterschedule_id' => $schedule->masterschedule_id,
                    'dateschedule' => $schedule->dateschedule,
                    'timeschedule' => $schedule->timeschedule,
                    'subject' => $subject->name,
                    'jp' => $schedule->jp,
                    'sessionschedule' => $schedule->sessionschedule,
                    'speaker' =>$speaker->name,
                    'description' => $schedule->description,
                    'uniqueschedule' =>$uniqueschedule
                ));

                $printedschedule->save();
            }
            return redirect()->back()->with('message','Berhasil menyimpan data');
        }

        // return if someone has a schedule on current data
        foreach($schedule as $sched){
            return redirect()->back()->with('message','Maaf beliau sedang mengajar di '.$sched->masterschedule->training->name.' pada tanggal '.$sched->dateschedule.' sesi ke : '.$sched->sessionschedule.' silahkan pilih tanggal lainnya');
        }
    }

    public function updatedetail(ScheduleRequest $request)
    {
        $schedule = Detailschedule::find($request->get('schedule_id'));
        /** 
         * check if date,user and session are different between existing and user request
         * if equals bypass check other schedule
        */
        if($schedule->user_id == $request->get('user_id') && $schedule->dateschedule == $request->get('dateschedule') && $schedule->sessionschedule == $request->get('sessionschedule')){
            // update schedule
            $schedule->update([
                'masterschedule_id' => $request->get('masterschedule_id'),
                'user_id' => $request->get('user_id'),
                'subject_id' => $request->get('subject_id'),
                'dateschedule' => $request->get('dateschedule'),
                'timeschedule' => $request->get('timeschedule'),
                'sessionschedule' => $request->get('sessionschedule'),
                'jp' => $request->get('jp'),
                'description' => $request->get('description')
            ]);

            return redirect()->back()->with('message','Berhasil Merubah Data');
        }else{
            $tanggal = Carbon::parse($request->get('dateschedule'));
            //check weekend
            if($tanggal->isWeekend()){
                return redirect()->back()->with('message','Hari Minggu tidak bisa dipilih sebagai hari diklat');
            }
            $isHoliday = new TanggalMerah();
            //check holiday 
            $isHoliday->set_date($tanggal);
            if($isHoliday->is_holiday()){
                return redirect()->back()->with('message','Hari Libur Nasional tidak bisa dipilih sebagai hari diklat');
            }
            // check if someone has a schedule on current session
            $aschedule=Detailschedule::where('user_id',$request->get('user_id'))->where('dateschedule',$request->get('dateschedule'))->where('sessionschedule',$request->get('sessionschedule'))->get();
            if($aschedule->isEmpty()){
                $schedule->update([
                    'masterschedule_id' => $request->get('masterschedule_id'),
                    'user_id' => $request->get('user_id'),
                    'subject_id' => $request->get('subject_id'),
                    'dateschedule' => $request->get('dateschedule'),
                    'timeschedule' => $request->get('timeschedule'),
                    'sessionschedule' => $request->get('sessionschedule'),
                    'jp' => $request->get('jp'),
                    'description' => $request->get('description')
                ]);

                // update printed schedule table while the schedule changed by user
                // so the printed keep synchronous with the detailschedule
                if($schedule->uniqueschedule!=null){
                    $subject = Subject::find($schedule->subject_id);
                    $speaker = User::find($schedule->user_id);
                    $printedschedule = Printedschedule::where('uniqueschedule',$schedule->uniqueschedule)->firstOrFail();
                    $printedschedule->update([
                        'masterschedule_id' => $schedule->masterschedule_id,
                        'dateschedule' => $schedule->dateschedule,
                        'timeschedule' => $schedule->timeschedule,
                        'subject' => $subject->name,
                        'jp' => $schedule->jp,
                        'sessionschedule' => $schedule->sessionschedule,
                        'speaker' =>$speaker->name,
                        'description' => $schedule->description,
                    ]);
                }

                return redirect()->back()->with('message','Berhasil Merubah Data');                
            }
            // return if someone has a schedule on current data
            foreach($aschedule as $sched){
                return redirect()->back()->with('message','Maaf beliau sedang mengajar di '.$sched->masterschedule->training->name.' pada tanggal '.$sched->dateschedule.' sesi ke : '.$sched->sessionschedule.' silahkan pilih tanggal lainnya');
            }
        }
    }

    public function deletedetail(Request $request)
    {
        $detail= Detailschedule::find($request->get('schedule_id'));
        // delete data on printedschedule if there belongs to detailschedule
        if($detail->uniqueschedule!=null){
            $printedschedule = Printedschedule::where('uniqueschedule',$detail->uniqueschedule)->firstOrFail();
            $printedschedule->delete();
        }
        // delete detailschedule here
        $detail->delete();
        return redirect()->back()->with('message','Berhasil Menghapus Data');
    }

    /**
     * print detailschedule from master pages
     */
    public function printdetailschedule($type,$mschedule_id)
    {
        $mschedule = Masterschedule::where('type',$type)->where('id',$mschedule_id)->firstOrFail();
        //return view('report.schedules.detailschedule',compact('mschedule'));
        $pdf = PDF::loadView('report.schedules.detailschedule',compact('mschedule'))
        ->setPaper('a4')
        ->setOrientation('landscape');
        return $pdf->download($mschedule->name.'schedule.pdf');    
    }

    // ajax datatables for detailschedules
    public function getdetailschedules(Request $req)
    {
        $mschedule_id = $req->get('q');
        $schedules=Detailschedule::with('user','subject')->where('masterschedule_id',$mschedule_id)->orderBy('dateschedule','asc')->get();
        return DataTables::of($schedules)
        ->addColumn('action',function($schedule){
            return view('schedule.tbbutton',compact('schedule'));
        })->toJson();
    }

    // printed schedules configuration start here

    public function newprintedschedule(Request $req)
    {
        $printedschedule = new Printedschedule(array(
            'masterschedule_id' => $req->get('masterschedule_id'),
            'dateschedule' => $req->get('dateschedule'),
            'timeschedule' => $req->get('timeschedule'),
            'speaker' => $req->get('speaker'),
            'subject' => $req->get('subject'),
            'jp' => $req->get('jp'),
            'description' => $req->get('description'),
        ));

        $printedschedule->save();

        return redirect()->back()->with('message','Berhasil menyimpan data');
    }

    public function updatenewprintedschedule(Request $request)
    {
        //return $request->all();
        $printedschedule = Printedschedule::find($request->get('printedshcedule_id'));
        $printedschedule->update([
            'masterschedule_id' => $request->get('masterschedule_id'),
            'dateschedule' => $request->get('dateschedule'),
            'timeschedule' => $request->get('timeschedule'),
            'speaker' => $request->get('speaker'),
            'subject' => $request->get('subject'),
            'jp' => $request->get('jp'),
            'description' => $request->get('description'),
        ]);

        return redirect()->back()->with('message','Berhasil merubah data');
    }

    public function deleteprintedschedule(Request $request)
    {
        $printedschedule = Printedschedule::find($request->get('printedschedule_id'));
        $printedschedule->delete();
        return redirect()->back()->with('message','Berhasil menghapus data');
    }

    public function getprintedschedules(Request $req)
    {
        $mschedule_id = $req->get('q');
        $printedschedules = Printedschedule::where('masterschedule_id',$mschedule_id)->orderBy('dateschedule','asc')->get();
        return DataTables::of($printedschedules)
        ->addColumn('action',function($printedschedule){
            if($printedschedule->uniqueschedule==null){
                return view('schedule.tbbutton-printedschedule',compact('printedschedule'));
            }else{
                return 'Update data dari detail jadwal widyaiswara di tabel atas';
            }
        })->toJson();
    }
}

