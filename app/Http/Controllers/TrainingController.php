<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Training;
use App\Pic;
use DataTables;
use Carbon\Carbon;
use Grei\TanggalMerah;

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
        }])->get();
        return DataTables::of($trainings)
        ->addColumn('schedule',function($training){
            return view('training.tbschedule',compact('training'));
        })
        ->addColumn('action',function($training){
            return view('training.tbbutton',compact('training'));
        })->rawColumns(['schedule','action'])->toJson();
    }
}
